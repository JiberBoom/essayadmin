<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteCate;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercurySeries\Flashy\Flashy;
use DB;
use YuanChao\Editor\EndaEditor;

class NotesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $where ['a.status'] ='1';//状态正常
//        $where['a.review'] ='1';//已审核
        $title =$request->get('title');
        $category = $request->get('pname');
        $uname = $request->get('uname');
        $notes = DB::table('notes as a')
                ->select('a.*','b.name as pname','c.name as uname')
                ->where('a.title','like','%'.$title.'%')
                ->where('c.name','like','%'.$uname.'%')
                ->where('b.name','like','%'.$category.'%')
                ->leftjoin('note_cates as b','a.parentid','=','b.id')
                ->leftjoin('users as c','a.uid','=','c.id')
                ->paginate(9);

        return view('notes.index',compact('notes','title','category','uname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $notecates = NoteCate::get();

        return view('notes.create',compact('notecates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests = $request->all();

        if(strlen($request['content'])<20){
            Flashy::error('友情提示:笔记内容要详细哦!');
        }else{
            $data['uid'] =Auth::id();
            $data['parentid'] = $requests['parentid'];
            $data['title'] = $requests['title'];
            $data['content'] = $requests['content'];
            $data['source'] = $requests['source'];
            $data['review'] = '1';
            $res = Note::create($data);
            if(false !==$res){
                Flashy::success('恭喜你🎉，记笔记成功!');
            }else{
                Flashy::error('笔记记录失败，稍后重试!');
            }
        }
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where['a.id'] = $id;
        $noteinfos = DB::table('notes as a')
            ->select('a.*','b.name as pname','c.name as uname')
            ->where($where)
            ->leftjoin('note_cates as b','a.parentid','=','b.id')
            ->leftjoin('users as c','a.uid','=','c.id')
            ->first();
        $noteinfos->content =EndaEditor::MarkDecode($noteinfos->content);

        return view('notes.show',compact('noteinfos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noteinfos = DB::table('notes as a')
                 ->select('a.id','a.parentid','a.title','a.content','a.source','b.name as pname')
                 ->leftjoin('note_cates as b','a.parentid','=','b.id')
                 ->where('a.id',$id)
                 ->first();

        $notecates = NoteCate::get();
        return view('notes.edit',compact('noteinfos','notecates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post_data['title'] = $request->get('title');
        $post_data['content'] = $request->get('content');
        $post_data['parentid'] = $request->get('parentid');
        $post_data['source'] = $request->get('source');
        Note::where('id',$id)->update($post_data);

        return redirect('notes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Note::where('id',$id)->delete();

        if(false !==$res){
            Flashy::success('删除成功！');
        }else{
            Flashy::error('删除失败！');
        }
        return back();
    }

    public function review($id,$review)
    {
        $data['review'] = $review;
        Note::where('id',$id)->update($data);
        return redirect('notes');
    }
}
