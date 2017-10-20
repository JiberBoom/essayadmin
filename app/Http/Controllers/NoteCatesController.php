<?php

namespace App\Http\Controllers;

use App\Models\NoteCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteCatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorts = DB::select("select a.*,concat(a.path,',',a.parentid) as paths,b.name as aname from note_cates as a left join note_cates as b on a.parentid=b.id where a.status=1 order by paths");

//        $sorts = DB::table('note_cates as a')
//            ->leftJoin('note_cates as b', 'a.parentid', '=', 'b.id')
//            ->where('a.status', '=', 1)
//            ->select('a.*','b.name as aname',concat(a.path,',',a.parentid) as paths)
//            ->orderBy('paths', 'desc')
//            ->first();
//        return $sorts;die;

        //concat(a.path,",",a.aid) as paths  是为了按照paths排序;b.aname as names为了返回pid所对应的aname
        foreach ($sorts as $key => $value) {
            //拆分path中的元素 目的是判断path中有几个逗号然后添加填充
            $tmp = explode(',', $value->path);
            //统计数组的元素个数
            $counts = count($tmp)-1;
            //添加分隔符
            $value->aname = str_repeat('|-------', $counts).$value->aname;
        }

        return view('notecates.index',compact('sorts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notecates = NoteCate::get();

        return view('notecates.create',compact('notecates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parentid = $request->get('parentid');
        $data=array();
        $data['name'] = $request->get('name');
        $data['parentid'] = empty($request->get('parentid')) ? 0 : $request->get('parentid');
        $data['created_at'] = date('Y-m-d H:i:s',time());
        if($data['parentid']){
            $info=NoteCate::find($parentid);
            //非顶级分类
            $data['depth']=count(explode(',',$info['path']))+1;
        }
        $lastid = NoteCate::insertGetId($data);
        if($lastid){
            $infos['path'] =empty($info['path']) ? $lastid : $info['path'].','.$lastid;
            $res = NoteCate::where('id',$lastid)->update($infos);
            if(false !==$res){
                return back();
            }else{
                die('更新路径失败');
            }
        }else{
            die('插入失败！');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
