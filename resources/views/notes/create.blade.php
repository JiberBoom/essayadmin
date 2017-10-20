@extends('layouts.layout')
@include('vendor.ueditor.assets')
@section('content')

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>新增笔记</legend>
    </fieldset>
    <form class="layui-form" action="{{route('notes.store')}}" method="post">
        {{ csrf_field() }}


        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{ old('title') }}" >
            </div>
        </div>

        <div class="layui-form-item layui-form-text {{ $errors->has('content') ? ' has-error' : '' }}">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block editor">
                <!-- 编辑器容器 -->
                {{--<script id="container" lay-verify="required" name="content" type="text/plain" ></script>--}}
                <textarea id='myEditor' name="content"></textarea>
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
                        <option value="{{$notecate->id}}">{{$notecate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">来源</label>
            <div class="layui-input-block">
                <input type="text" name="source"  value="{{ old('source') }}" lay-verify="" autocomplete="off" placeholder="请输入来源链接" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <!-- 实例化安正超的百度编辑器 -->
    {{--<script type="text/javascript">--}}
        {{--var ue = UE.getEditor('container',{--}}
            {{--initialFrameWidth : 1100,--}}
            {{--initialFrameHeight: 250,--}}
            {{--toolbars: [--}}
                {{--['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'snapscreen','date','time','map','cleardoc','fullscreen']--}}
            {{--],--}}
            {{--elementPathEnabled: false,--}}
            {{--enableContextMenu: false,--}}
            {{--autoClearEmptyNode:true,--}}
            {{--wordCount:false,--}}
            {{--imagePopup:false,--}}
            {{--autotypeset:{ indent: true,imageBlockLine: 'center' }--}}
        {{--});--}}
        {{--ue.ready(function() {--}}
            {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.--}}
        {{--});--}}
    {{--</script>--}}
    <script>

        //Demo
        layui.use('form', function(){
            var form = layui.form;
            //创建一个编辑器
//            var editIndex = layedit.build('LAY_demo_editor');

            //自定义验证规则
            form.verify({
                title: function(value){
                    if(value.length < 5){
                        return '标题至少得5个字符啊';
                    }
                }
//                ,content: function(value){
//                    layedit.sync(editIndex);
//                    if(value.length < 5){
//                        return '内容至少得多写点啊';
//                    }
//                }
            });
            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });
    </script>

@endsection

