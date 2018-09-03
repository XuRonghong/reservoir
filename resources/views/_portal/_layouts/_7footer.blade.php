<footer>
    <div class="container">
        <div class="shareBox">
            <a href="javascript:;" class="servicePhone">
                <div class="phoneBox">
                    <div>
                        <ion-icon name="time"></ion-icon>
                        <span>09:00 - 18:00</span>
                    </div>
                    <div>
                        <ion-icon name="call"></ion-icon>
                        <span>0800 211 028</span>
                    </div>
                </div>
{{--                {{trans('_portal.footer.service_phone')}}--}}
            </a>
            {{--@foreach($_footer as $item)--}}
                {{--<a href="{{$item->vUrl or '#'}}">{{$item->vName or ''}}</a>--}}
            {{--@endforeach--}}
        </div>
        <p class="footerStr">{{trans('_portal.footer.copyright')}}</p>
    </div>
</footer>