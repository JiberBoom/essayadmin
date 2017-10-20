@extends('layouts.layout')
@section('content')
    <div class="layui-container">
        <table class="layui-table">
            <thead>
            <tr>
                <th>分类ID</th>
                <th>分类名</th>
                <th>路径</th>
                <th>层级</th>
                <th>父级名称</th>
                <th>创建时间</th>

            </tr>
            </thead>
            <tbody>
            @foreach($sorts as $sort)
                <tr>
                    <td>{{$sort->id}}</td>
                    <td>{{$sort->name}}</td>
                    <td>{{$sort->path}}</td>
                    <td>{{$sort->depth}}</td>
                    <td>
                        @if(empty($sort->aname))
                                <span class="layui-bg-red">顶级分类</span>
                            @else
                                {{$sort->aname}}
                        @endif
                    </td>
                    <td>{{$sort->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')

@endsection
