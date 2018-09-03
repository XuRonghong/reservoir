
<meta charset="UTF-8">
<meta name="viewport" content="width=1000">
<meta http-equiv="content-language" content="{{config('app.locale')}}" />

<meta property="og:url" content="{{$og['url'] or ""}}"/>
<meta property="og:type" content="{{$og['type'] or ""}}"/>
<meta property="og:title" content="{{$og['title'] or ""}}"/>
<meta property="og:image" content="{{$og['images'] or ""}}"/>
<meta property="og:description" content="{{$og['description'] or ""}}"/>

<meta property="fb:app_id" content="{{config('_config.fb_appid')}}" />