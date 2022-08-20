<?php

namespace App\Http\Controllers\QA;

use App\Http\Controllers\Controller;
use App\Models\QA;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q_a = QA::all();
        return response()->json($q_a);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req,[
            'image' =>'required',
            'title'=>'required', 
            'content'=>'required', 
        ],[
            'image.required' => 'Bạn chưa chọn hình ảnh',
            'title.required' =>'Bạn chưa nhập câu hỏi',
            'content.required' =>'Bạn chưa nhập câu trả lời',
        ]);

        $q_a=new QA();
        $q_a->title=$req->title;
        $q_a->content=$req->content;
        $q_a->image=$req->image;
        $q_a->save();
        return 'Bạn đã thêm thành công';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qa = QA::find($id);
        return response()->json($qa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $name = '';        
        if($req -> hasFile('images')){
            $this->validate($req,[
                'image' =>'mimes:jpg,png,jpeg|max:2048',
            ],[
                'image.mimes'=>'Chỉ chấp nhận files ảnh',
                'image.max' => 'Chỉ chấp nhận files ảnh dưới 2Mb',

            ]);
            $file =$req ->file(('image'));
            $name = time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images');
            $file -> move($destinationPath, $name);
        }
        $this->validate($req,[
            'title'=>'required', 
            'content'=>'required', 
        ],[
            'title.required' =>'Bạn chưa nhập câu hỏi',
            'content.required' =>'Bạn chưa nhập câu trả lời',
        ]);
        $q_a= QA::find($id);
        $q_a->title=$req->title;
        $q_a->content=$req->content;
        $q_a->image=$name;
        $q_a->save();

        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $q_a = QA::find($id);
        $linkImage = public_path('images/') . $q_a->image;
        $q_a->delete();
        return 1;
    }
}
