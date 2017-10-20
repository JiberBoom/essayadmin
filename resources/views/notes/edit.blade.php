@extends('layouts.layout')
@include('vendor.ueditor.assets')
@section('content')

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>编辑笔记</legend>
    </fieldset>
    <form class="layui-form" action="{{route('notes.update',$noteinfos->id)}}" method="post" enctype="multipart/form-data">
        {{method_field('PATCH')}}
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$noteinfos->title}}" >
            </div>
        </div>

        <div class="layui-form-item layui-form-text {{ $errors->has('content') ? ' has-error' : '' }}">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">

                <textarea id='myEditor' name="content">{!! $noteinfos->content !!}</textarea>

                @if ($errors->has('content'))
                    <span class="help-block">
                         <strong>{{ $errors->first('content') }}</strong>
                     </span>
                @endif
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
                <select title="" name="parentid" lay-verify="required">
                    <option value=""></option>
                    @foreach($notecates as $notecate)
                        <option @if($noteinfos->parentid = $notecate->id) selected @endif value="{{$notecate->id}}">{{$notecate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">来源</label>
            <div class="layui-input-block">
                <input type="text" name="source"  value="{{ $noteinfos->source }}" lay-verify="" autocomplete="off" placeholder="请输入来源链接" class="layui-input">
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

            //自定义验证规则
            form.verify({
                title: function(value){
                    if(value.length < 5){
                        return '标题至少得5个字符啊';
                    }
                }
            });
            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });
    </script>

@endsection

