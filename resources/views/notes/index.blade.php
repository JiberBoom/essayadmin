@extends('layouts.layout')
@section('content')
    <div class="layui-container">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>笔记列表</legend>
        </fieldset>
        <form action="{{route('notes.index')}}" method="get" class="layui-form">
            <div class="layui-container">
                <div class="layui-row">
                    <div class="layui-col-md3">
                        标题 &nbsp;<input type="text" name="title" class="" value="{{$title}}">
                    </div>

                    <div class="layui-col-md3">
                        类别 &nbsp;<input type="text" name="pname" class="" value="{{$category}}">
                    </div>

                    <div class="layui-col-md3">
                        作者 &nbsp;<input type="text" name="uname" class="" value="{{$uname}}">
                    </div>
                    <div class="layui-col-md3">
                        <button class="layui-btn layui-btn-small" type="submit">查询</button>
                    </div>
                </div>

            </div>
        </form>


        <table class="layui-table" style="text-align: center">
            <thead>
            <tr>
                <td>笔记ID</td>
                <td>标题</td>
                <td>分类</td>
                <td>作者</td>
                <td>是否审核</td>
                <td>是否展示</td>
                <td>创建时间</td>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>{{$note->id}}</td>
                    <td>{{$note->title}}</td>
                    <td>{{$note->pname}}</td>
                    <td>{{$note->uname}}</td>
                    <td>
                        @if($note->review =='1')
                                <span class="layui-bg-green">已通过</span>
                            @elseif($note->review =='-1')
                               <span class="layui-bg-red">未通过</span>
                            @else
                                <span class="layui-bg-gray">待审核</span>
                        @endif
                    </td>
                    <td>
                        @if($note->status=='1')
                             <span class="layui-bg-green">是</span>
                            @else
                            <span class="layui-bg-red">否</span>
                            @endif
                    </td>
                    <td>{{$note->created_at}}</td>
                    <td>
                        <a href="{{route('notes.create')}}">
                            <img width="15" height="15" src="/storage/static/add.png" alt="增加" title="增加笔记">
                            {{--<button class="layui-btn layui-btn-small layui-btn-radius">增加</button>--}}
                        </a>

                        <form style="display: inline" action="{{route('notes.destroy',$note->id)}}" method="post">
                            {{method_field('DELETE')}}
                            {!! csrf_field() !!}

                            <input type="image" src="/storage/static/delete.png" width="15" height="15" onclick="return confirm('确定要删除吗?')" alt="删除" title="删除笔记">
                        </form>
                        <a href="{{route('notes.edit',$note->id)}}">
                            <img width="15" height="15" src="/storage/static/edit.png" alt="编辑" title="编辑笔记">
                        </a>

                        <a href="{{route('notes.show',$note->id)}}">
                            <img width="15" height="15" src="/storage/static/info.png" alt="查看笔记" title="{{$note->title}}">
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="layui-row">
            <div class="layui-col-md3 col-md-offset-5">
                {!! $notes->render() !!}
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(function () {
            $("#search").on('click',function () {
                let title = $('input[name="title"]').val();
                let pname = $("input[name='pname']").val();
                let uname = $("input[name='uname']").val();
                $.ajax({
                    type:'GET',
                    url:'notes',
                    data:{title:title,pname:pname,uname:uname},
                    cache:false,
                    dateType:"json",
                    success:function (data) {
                        alert(data);
                    }

                });
            });
        });

    </script>
@endsection
