@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>文章列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷导航结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>阅读次数</th>
                        <th>作者</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->id}}</td>
                        <td><a href="#">{{$v->title}}</a></td>
                        <td>{{$v->view}}</td>
                        <td>{{$v->editor}}</td>
                        <td>{{date('Y-m-d',$v->time)}}</td>
                        <td>
                            <a href="{{url('admin/article/'.$v->id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delArt({{$v->id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="page_list">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>

    <style>
        .result_content ul li span{
            font-size: 15px;
            padding:6px 12px;
        }
    </style>

    <script>
        function delArt(id){
            layer.confirm('您确认要删除此文章吗？',{
                btn:['确认','取消']
            },function (){
                $.post("{{url('admin/article/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if (data.status == 0){
                        location = location;
                        layer.msg(data.msg,{icon:6});
                    }else{
                        location = location;
                        layer.msg(data.msg,{icon:5});
                    }
                });
            },function () {

            });
        }
    </script>
@endsection