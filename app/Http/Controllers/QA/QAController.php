<?php

namespace App\Http\Controllers\QA;

use App\Http\Controllers\Controller;
use App\Models\QA;
use Illuminate\Http\Request;

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
            'title.required' =>'Bạn chưa nhập chủ đề câu hỏi',
            'content.required' =>'Bạn chưa nhập nội dung',
        ]);

        $qa=new QA();
        $qa->title=$req->title;
        $qa->content=$req->content;
        $qa->image=$req->image;
        $qa->save();
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
            'q_a_name.required' =>'Bạn chưa nhập tên điện thoại',
            'description.required' =>'Bạn chưa nhập mô tả',
            'content.required' =>'Bạn chưa nhập giá',
        ]);
        $q_a= QA::find($id);
        $q_a->q_a_name=$req->q_a_name;
        $q_a->content=$req->content;
        $q_a->version_id=$req->version_id;
        $q_a->service_id=$req->service_id;
        $q_a->img=$name;
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
        $QA = QA::find($id);
        $linkImage = public_path('images/') . $QA->image;
        $QA->delete();
        return 1;
    }
}
