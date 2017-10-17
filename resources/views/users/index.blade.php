@extends('layouts.layout')

@section('content')

    <div class="layui-container">
        {{--<div class="layui-row">--}}
            {{--<div class="layui-col-md3">--}}
                {{--<div class="pagination layui-bg-blue">用户列表</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <table class="layui-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>微信</th>
                <th>QQ</th>
                <th>级别</th>
                <th>加入时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->weixin}}</td>
                    <td>{{$user->qq}}</td>
                    <td>
                        @if($user->level==1)
                            英勇黄铜
                        @elseif($user->level==2)
                            不屈白银
                        @elseif($user->level==3)
                            荣耀黄金
                        @elseif($user->level==4)
                            华贵铂金
                        @elseif($user->level==5)
                            璀璨钻石
                        @elseif($user->level==6)
                            超凡大师
                        @elseif($user->level==7)
                            最强王者
                        @else
                            段位异常
                        @endif
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        @if($user->status=='1')
                            正常
                        @else
                            禁用
                        @endif
                    </td>
                    <td>
                        <a href="{{url('/users/'.$user->id.'/changeStatus/'.$user->status)}}" onclick="return confirm('确定要执行此操作吗？')">
                            <img width="30" height="30"
                                 @if($user->status) src="/storage/disable.png" alt="禁用" title="禁用操作"
                                 @else src="/storage/enable.png" alt="启用" title="启用操作"
                                    @endif >
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="layui-row">
            <div class="layui-col-md3 col-md-offset-5">
                {!! PaginateRoute::renderPageList($users,false,'pagination',true) !!}
            </div>

        </div>
    </div>


    {{--{!! $users->render() !!}--}}
@endsection
@section('js')

@endsection
