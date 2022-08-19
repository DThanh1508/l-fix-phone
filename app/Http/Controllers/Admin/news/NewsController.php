<?php

namespace App\Http\Controllers\Admin\news;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JD\Cloudder\Facades\Cloudder as FacadesCloudder;

class NewsController extends Controller
{
    function index() {
        echo 'hello';
    }

    // save a new news
    function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ], [
            'title.required' => 'Tiêu đề không được để trống!',
            'content.required' => 'Nội dung tin tức không được để trống!',
            'image.required' => 'Hình ảnh của tin tức không được để trống!'
        ]);

        if ($validator->fails()) {
           return response()->json(['message'=> 'Yêu cầu thực hiện không thành công!',
        "errors" => $validator->errors()], 400);
        }
        // upload images into cloud
        $content = $request->content;
        $dom  = new \DomDocument();
        //convert utf-8 to html entities
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
        $dom->loadHTML($content, LIBXML_HTML_NODEFDTD);
        $images =  $dom->getElementsByTagName('img');

        // push into cloud images
        foreach ($images as $k => $image) {
            $name = time() . '_' . uniqid() . '.png';
            FacadesCloudder::upload(file_get_contents($image->getAttribute('src'))
            , [
                'public_id' => $name
            ]);
            $image->removeAttribute('src');
            // link https://viblo.asia/p/tim-hieu-package-cloudinary-trong-laravel-RnB5pnArZPG#_demo-12
            $image->setAttribute('src', $cloudinaryUpload->getSecurePath());
        }
        $news = News::create($request->all());
        return response()->json(['message' => 'Tạo tin tức thành công!',
        'news' => $news], 200);
    }

    // update a news

function update(Request $request, $id) {
    $news = News::find($id);
    if (is_null($news)) {
        return response()->json(['message'=>'Khong tim thay tin tuc'], 404);
    }
    $news->update($request->all());
    return response()->json(['message'=>'chinh sua tin tuc thanh cong', 'news'=>$news], 200);
}

// delete a news
function delete($id) {
    $news = News::find($id);
    if (is_null($news)) {
        return response()->json(['message'=>'Khong tim thay tin tuc'], 404);
    }
    $news->delete();
    return response()->json(['message'=>'Xoa tin tuc thanh cong'], 204);
}
}