@extends('layouts.home')
@section('info')
    <title>{{$field->name}}--{{Config::get('web.title')}}</title>
    <meta name="keywords" content="{{$field->keywords}}">
    <meta name="description" content="{{$field->description}}">
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>“慢生活”不是懒惰，放慢速度不是拖延时间，而是让我们在生活中寻找到平衡。</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cate/'.$field->id)}}" class="n2">{{$field->name}}</a></h1>
        <div class="newblog left">
            @foreach($data as $d)
                <h2>{{$d->title}}</h2>
                <p class="dateview">&nbsp;<span>发布时间：{{date('Y-m-d',$d->time)}}</span><span>作者：{{$d->editor}}</span><span>分类：[<a href="{{url('cate/'.$field->id)}}">{{$field->name}}</a>]</span></p>
                <figure><img src="{{url($d->thumb)}}"></figure>
                <ul class="nlist">
                    <p>{{$d->description}}</p>
                    <a title="{{$d->title}}" href="{{url('a/'.$d->id)}}" target="_blank" class="readmore">阅读全文>></a>
                </ul>
                <div class="line"></div>
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
            @if($submenu->all())
            <div class="rnav">
                <ul>
                    @foreach($submenu as $k => $s)
                        <li class="rnav{{$k+1}}"><a href="{{url('cate/'.$s->id)}}" target="_blank">{{$s->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="news">
                @parent
            </div>

        </aside>
    </article>
@endsection