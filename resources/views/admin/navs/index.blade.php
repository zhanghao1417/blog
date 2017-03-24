@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 全部导航
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>导航列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加导航</a>
                    <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>全部导航</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>导航名称</th>
                        <th>导航别名</th>
                        <th>导航地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v->id}})" value="{{$v->orders}}">
                        </td>
                        <td class="tc">{{$v->id}}</td>
                        <td>
                            <a href="#">{{$v->name}}</a>
                        </td>
                        <td>{{$v->alias}}</td>
                        <td>{{$v->url}}</td>
                        <td>
                            <a href="{{url('admin/navs/'.$v->id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delLinks({{$v->id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>

    <script>
        function changeOrder(obj,id){
            var order = $(obj).val();
            $.post("{{url('admin/navs/changeorder')}}",{'_token':'{{csrf_token()}}','id':id,'order':order},function(data){
                if(data.status == 0){
                    location = location;
                    layer.msg(data.msg, {icon: 6});
                }else{
                    location = location;
                    layer.msg(data.msg, {icon: 5});
                }
            });
        }

        //删除分类js
        function delLinks(id){
            layer.confirm('您确认要删除导航吗？',{
                btn:['确认','取消']
            },function (){
                $.post("{{url('admin/navs/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if (data.status == 0){
                        location = location;
                        layer.msg(data.msg,{icon:6});
                    }else{
                        location = location;
                        layer.msg(data.msg,{icon:5});
                    }
                });
            });
        }
    </script>
@endsection