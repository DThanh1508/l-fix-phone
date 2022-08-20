<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function getAllPosts(){
        return response()->json([Post::all()], 200);
    }
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

        $q_a=new Post();
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
        $Post = Post::find($id);
        return response()->json($Post);
    }
}
