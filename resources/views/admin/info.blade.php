@extends('layouts.admin')
@section('content')
	<!--面包屑导航 开始-->
	<div class="crumb_warp">
		<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 系统基本信息
	</div>
	<!--面包屑导航 结束-->

    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>
                <li>
                    <label>当前系统版本</label><span>v-0.1</span>
                </li>
                <li>
                    <label>上传附件限制</label><span><?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传文件"; ?></span>
                </li>
                <li>
                    <label>北京时间</label><span><?php echo date('Y年m月d日 G时i分s秒'); ?></span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{$_SERVER['SERVER_NAME']}}&nbsp;&nbsp;[{{$_SERVER['SERVER_ADDR']}}]</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>技术支持</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>邮箱：</label><span><a href="#">18535525972@163.com</a></span>
                </li>
            </ul>
            <ul>
                <li>
                    <label>Q Q：</label><span><a href="#">872713098</a></span>
                </li>
            </ul>
        </div>
    </div>
	<!--结果集列表组件 结束-->
@endsection