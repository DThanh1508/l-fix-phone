<?php

namespace App\Http\Controllers\Version;

use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $versions = Version::join('brands', 'brands.id', 'versions.brand_id')
            ->select('brands.name', 'versions.*')
            ->get();
        if ($versions) {
            return response()->json($versions, Response::HTTP_OK);
        } else {
            return response()->json([]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'brand_id'=>'required', 
            'version_name'=>'required'
        ],[
            'brand_id.required' =>'No empty',
            'version_name.required' =>'No empty'
        ]);

        $version=new Version();
        $version->brand_id=$req->brand_id;
        $version->version_name=$req->version_name;
        $version->save();
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
        $products = Version::find($id);
        //Xoa luon anh trong thu muc, neu ko co cau lenh nay thi khi xoa anh van con trong thu muc
        // if (File::exists($linkImage)) {
        //     File::delete($linkImage);
        // }
        $products->delete();
        return 'Ok! Xoa duoc roi:))';
    }
}
