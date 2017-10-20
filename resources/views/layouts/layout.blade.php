<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>
    <link rel="stylesheet" href="/storage/layui/css/layui.css">
    <script src="/storage/layui/layui.js"></script>

</head>
<body class="layui-layout-body">
@guest
呵呵哒~~
@else
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <a href="{{ url('/home') }}">
            <div class="layui-logo">
                {{config('app.name','Laravel')}}
            </div>
        </a>
        @guest
            赶紧登陆去。。。
        @else
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="">控制台</a></li>
            <li class="layui-nav-item"><a href="">记笔记</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        @endguest
        <ul class="layui-nav layui-layout-right">
            <!-- Authentication Links -->
            @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="{{ Auth::user()->pic }}" class="layui-nav-img">
                        {{ Auth::user()->name }}
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="">基本资料</a></dd>
                        <dd><a href="">安全设置</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="{{ route('logout') }}"
                                              onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        退了
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endguest
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <li class="layui-nav-item layui-nav-itemed">
                    <a class="" href="javascript:;">笔记管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{route('notes.index')}}">笔记列表</a></dd>
                        <dd><a href="{{route('notes.create')}}">新增笔记</a></dd>

                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">笔记分类管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{route('notecates.index')}}">分类列表</a></dd>
                        <dd><a href="{{route('notecates.create')}}">新增分类</a></dd>

                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">用户管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{route('users.index')}}">用户列表</a></dd>
                    </dl>
                </li>

                <li class="layui-nav-item">
                    <a class="" href="javascript:;">轮播管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">轮播图片</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        @yield('content')
    </div>

    <div class="layui-footer" style="text-align: center">
        <!-- 底部固定区域 -->
        © copyright2017 - JiberBoom
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('js')
<script>
    layui.use(['element'],function () {
        
    });
</script>

@include('flashy::message')
@include('editor::head')
@endguest

</body>
</html>
