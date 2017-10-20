@extends('layouts.layout')
@include('vendor.ueditor.assets')
@section('content')

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>笔记详情</legend>
    </fieldset>
    {{--<div class="layui-container">--}}
        {{--<div class="layui-row">--}}
            {{--<div class="layui-col-md3">--}}
                {{--作者--}}
            {{--</div>--}}
            {{--<div class="layui-col-md9">--}}
                {{--{{$noteinfos->uname}}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<hr>--}}
        {{--<div class="layui-row">--}}
            {{--<div class="layui-col-md3">--}}
                {{--标题--}}
            {{--</div>--}}
            {{--<div class="layui-col-md9">--}}
                {{--{{$noteinfos->title}}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<hr>--}}
        {{--<div class="layui-row">--}}
            {{--<div class="layui-col-md3">--}}
                {{--内容--}}
            {{--</div>--}}
            {{--<div class="layui-col-md9">--}}
                {{--{!! $noteinfos->content !!}--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<hr>--}}
        {{--<div class="layui-row">--}}
            {{--<div class="layui-col-md3">--}}
                {{--来源--}}
            {{--</div>--}}
            {{--<div class="layui-col-md9">--}}
                {{--{{$noteinfos->source}}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<hr>--}}
        {{--<div class="layui-row">--}}
            {{--<div class="layui-col-md3">--}}
                {{--分类--}}
            {{--</div>--}}
            {{--<div class="layui-col-md9">--}}
                {{--{{$noteinfos->pname}}--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <form class="layui-form" >
        <div class="layui-form-item">
            <label class="layui-form-label">作者</label>
            <div class="layui-input-block">
                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$noteinfos->uname}}" >

            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$noteinfos->title}}" >
            </div>
        </div>

        <div class="layui-form-item layui-form-text {{ $errors->has('content') ? ' has-error' : '' }}">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">

                {!! $noteinfos->content !!}

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
                <input type="text" name="source"  value="{{ $noteinfos->pname }}" lay-verify="" autocomplete="off"  class="layui-input">
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
                <a href="/notes/{{$noteinfos->id}}/review/1"><button type="button" class="layui-btn" lay-filter="demo1">审核通过</button></a>
                &nbsp;&nbsp;
                <a href="/notes/{{$noteinfos->id}}/review/-1"><button type="button" class="layui-btn layui-bg-red" lay-filter="demo1">审核不通过</button></a>

            </div>
        </div>
    </form>

@endsection

