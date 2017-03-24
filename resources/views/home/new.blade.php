@extends('layouts.home')
@section('info')
    <title>{{$field['art']->title}}--{{Config::get('web.title')}}</title>
    <meta name="keywords" content="{{$field['art']->tag}}">
    <meta name="description" content="{{$field['art']->description}}">
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav">
            <a href="{{url('/')}}" class="n1">网站首页</a>
            <a href="{{url('cate/'.$field['art']->id)}}" class="n2">{{$field['cate']->name}}</a>
        </h1>
        <div class="index_about">
            <h2 class="c_titile">{{$field['art']->title}}</h2>
            <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$field['art']->time)}}</span><span>编辑：{{$field['art']->editor}}</span><span>查看次数：{{$field['art']->view}}</span></p>
            <ul class="infos">
                {!! $field['art']->content !!}
            </ul>
            <div class="keybq">
                <p><span>关键字词</span>：{{$field['art']->tag}}</p>
            </div>
            <div class="ad"> </div>
            <div class="nextinfo">
                @if($article['pre'])
                    <p>上一篇：<a href="{{url('a/'.$article['pre']->id)}}">{{$article['pre']->title}}</a></p>
                @else
                    <p>上一篇：<span>没有上一篇</span></p>
                @endif
                @if($article['next'])
                    <p>下一篇：<a href="{{url('a/'.$article['next']->id)}}">{{$article['next']->title}}</a></p>
                @else
                    <p>上一篇：<span>没有下一篇</span></p>
                @endif
            </div>
            <div class="otherlink">
                <h2>相关文章</h2>
                <ul>
                    @foreach($data as $d)
                        <li><a href="{{url('a/'.$d->id)}}" title="{{$d->title}}">{{$d->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <aside class="right">
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
            <!-- Baidu Button END -->
            <div class="blank"></div>
            <div class="news">
                @parent
            </div>
        </aside>
    </article>
@endsection