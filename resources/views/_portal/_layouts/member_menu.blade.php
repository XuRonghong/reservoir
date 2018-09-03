<div class="col-sm-3 Sidebar">
    <ul>
        <li class="@if($member_active == 'mycard') active @endif">
            <a href="{{url('member_center/mycard')}}">{{trans('_portal.member_center.menu.mycard')}}</a>
        </li>
        <li class="@if($member_active == 'information') active @endif">
            <a href="{{url('member_center/information')}}">{{trans('_portal.member_center.menu.information')}}</a>
        </li>
        <li class="@if($member_active == 'cart') active @endif">
            <a href="{{url('member_center/cart')}}">{{trans('_portal.member_center.menu.cart')}}</a>
        </li>
        <li class="@if($member_active == 'order') active @endif">
            <a href="{{url('member_center/order')}}">{{trans('_portal.member_center.menu.order')}}</a>
        </li>
        <li class="@if($member_active == 'success') active @endif">
            <a href="{{url('member_center/success')}}">{{trans('_portal.member_center.menu.success')}}</a>
        </li>
        <li class="@if($member_active == 'keep') active @endif">
            <a href="{{url('member_center/keep')}}">{{trans('_portal.member_center.menu.keep')}}</a>
        </li>
        <li class="@if($member_active == 'coin') active @endif">
            <a href="{{url('member_center/coin')}}">{{trans('_portal.member_center.menu.fly_money')}}</a>
        </li>
        {{--<li class="@if($member_active == 'coupon') active @endif">--}}
            {{--<a href="{{url('member_center/coupon')}}">{{trans('_portal.member_center.menu.coupon')}}</a>--}}
        {{--</li>--}}
        @if(session('shop_member.iAcType') == 51)
            <li class="@if($member_active == 'blogger') active @endif">
                <a href="{{url('member_center/blogger')}}">{{trans('_portal.member_center.menu.blog')}}</a>
            </li>
        @endif
        <li>
            <a href="#" class="logout">{{trans('_portal.member_center.menu.logout')}}</a>
        </li>
    </ul>
</div>