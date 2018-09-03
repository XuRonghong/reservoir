<header>
    <div class="headerCenter container">
        <a href="{{url('')}}" class="logoBox">
            <img src="{{asset('portal_assets/dist/img/logo.png')}}" alt="">
        </a>
        <div class="linkBox">
            <a href="{{url('news')}}">{{trans('_portal.news.title')}}</a>
            @if(isset($_header))
            @foreach($_header as $item)
                <a href="{{$item->vUrl or '#'}}">{{$item->vName or ''}}</a>
            @endforeach
            @endif
        </div>
        <div class="statusBox">
            <a href="{{url('member_center')}}" data-url="{{url('cart')}}" class="cartBox">
                <ion-icon ios="ios-cart" md="md-cart" class="icon-cart"></ion-icon>
            </a>
            <a href="{{url('member_center')}}" class="greetBox">
                <ion-icon ios="ios-contact" md="md-contact" class="icon-user"></ion-icon>
                <div>
                    <p>{{session()->get( 'sys_group.vGroupName' , '')}}</p>
                    <p>
                        <span>{{session()->get( 'shop_member.info.vUserName' , '')}}</span>
                        {{trans('_portal.header.howareyou')}}
                    </p>
                </div>
            </a>
        </div>
    </div>
    <script>
        $('.cartBox').click(function () {
            $(this).attr('href', null);
            window.location.href = $(this).data('url');
        })
    </script>
</header>