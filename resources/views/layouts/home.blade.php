<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        @yield('info')
        <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
        <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
        <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
        <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            <div id="logo"><a href="/"></a></div>
            <nav class="topnav" id="topnav">
                @foreach($navs as $k=>$v)
                    <a href="{{url($v->url)}}"><span>{{$v->name}}</span><span class="en">{{$v->alias}}</span></a>
                @endforeach
            </nav>
        </header>

        @section('content')
            <h3>
                <p>最新<span>文章</span></p>
            </h3>
            <ul class="rank">
                @foreach($new as $n)
                    <li><a href="{{url('a/'.$n->id)}}" title="{{$n->title}}" target="_blank">{{$n->title}}</a></li>
                @endforeach
            </ul>
            <h3 class="ph">
                <p>点击<span>排行</span></p>
            </h3>
            <ul class="paih">
                @foreach($hotB as $h)
                    <li><a href="{{url('a/'.$h->id)}}" title="{{$h->title}}" target="_blank">{{$h->title}}</a></li>
                @endforeach
            </ul>
        @show

        <footer>
            <p>{{Config::get('web.copyright')}}-{{Config::get('web.count')}}</p>
        </footer>
        <script src="{{asset('resources/views/home/js/silder.js')}}"></script>
    </body>
</html>