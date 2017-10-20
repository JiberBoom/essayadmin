@extends('layouts.layout')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>新增笔记分类</legend>
    </fieldset>
    <form class="layui-form" action="{{route('notecates.store')}}" method="post">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">父类</label>
            <div class="layui-input-block">
                <select title="" name="parentid" lay-verify="">
                    <option value=""></option>
                    @foreach($notecates as $notecate)
                        <option value="{{$notecate->id}}">{{$notecate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入分类名称" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <script>
        //Demo
        layui.use('form', function(){
            var form = layui.form;

            //监听提交
//            form.on('submit(formDemo)', function(data){
//                layer.msg(JSON.stringify(data.field));
//                return false;
//            });
        });
    </script>

@endsection

