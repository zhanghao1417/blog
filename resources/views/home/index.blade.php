@extends('layouts.home')
@section('info')
    <title>{{Config::get('web.title')}}--{{Config::get('web.seo_title')}}</title>
    <meta name="keywords" content="{{Config::get('web.keywords')}}">
    <meta name="description" content="{{Config::get('web.description')}}">
@endsection
@section('content')
    <div class="banner">
        <section class="box">
            <ul class="texts">
                <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
                <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
                <p>加了锁的青春，不会再因谁而推开心门。</p>
            </ul>
            <div class="avatar"><a href="#"><span>HUSKY</span></a> </div>
        </section>
    </div>
    <div class="template">
        <div class="box">
            <h3>
                <p><span>HOT</span> Recommend</p>
            </h3>
            <ul>
                @foreach($hotA as $h)
                    <li><a href="{{url('a/'.$h->id)}}"  target="_blank"><img src="{{url($h->thumb)}}"></a><span>{{$h->title}}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
    <article>
        <h2 class="title_tj">
            <p>文章<span>推荐</span></p>
        </h2>
        <div class="bloglist left">
            @foreach($data as $d)
            <h3>{{$d->title}}</h3>
            <figure><img src="{{url($d->thumb)}}"></figure>
            <ul>
                <p>{{$d->description}}</p>
                <a title="{{$d->title}}" href="{{url('a/'.$d->id)}}" target="_blank" class="readmore">阅读全文&gt;&gt;</a>
            </ul>
            <p class="dateview">&nbsp;<span>{{date('Y-m-d',$d->time)}}</span><span>作者：{{$d->editor}}</span></p>
            @endforeach
            <div class="page">
                {{$data->links()}}
            </div>
        </div>
        <!-- Baidu Button BEGIN -->
        <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
        <script type="text/javascript" id="bdshell_js"></script>
        <script type="text/javascript">
            document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
        </script>
        <!-- Baidu Button END -->
        <aside class="right">
            <div class="news">
                @parent
                <h3 class="links">
                    <p>友情<span>链接</span></p>
                </h3>
                <ul class="website">
                    @foreach($links as $l)
                        <li><a href="{{$l->url}}" target="_blank">{{$l->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </article>
@endsection