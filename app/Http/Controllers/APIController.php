<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Version;
use App\Models\Service;
use App\Models\Admin;
use App\Models\Customer;

class APIController extends Controller
{
    /**
     *
     */
    public function version()
    {

        $versions = Version::join('brands', 'brands.id', 'versions.brand_id')
            ->select('brands.name', 'versions.*')
            ->paginate(20);
        if ($versions) {
            return response()->json($versions, Response::HTTP_OK);
        } else {
            return response()->json([]);
        }
    }

    /**
     *
     */
    public function products()
    {
        $products = Product::join('services', 'services.id', 'products.service_id')
        ->select('services.service_name', 'products.*')
        ->paginate(20);
    if ($products) {
        return response()->json($products, Response::HTTP_OK);
    } else {
        return response()->json([]);
    }
    }

    /**
     *
     */
    public function customer()
    {
        $customers = Customer::join('products', 'products.id', 'customers.product_id')
        ->select('products.product_name', 'customers.*')
        ->paginate(20);
    if ($customers) {
        return response()->json($customers, Response::HTTP_OK);
    } else {
        return response()->json([]);
    }
    }


    public function getProductDetail($id){
        $products = Product::find($id);
        return response()->json($products);
    }
    public function store(Request $request)
    {
        //
    }

    /**
     *
     */
    public function show($id)
    {
        //
    }

    /**
     *
     */
    public function edit($id)
    {
        //
    }

    /**
     *
     */
    public function update(Request $req, $id)
    {
        $name = '';
        
        if($req -> hasFile('img')){
            $this->validate($req,[
                'img' =>'mimes:jpg,png,jpeg|max:2048',
            ],[
                'img.mimes'=>'Chỉ chấp nhận files ảnh',
                'img.max' => 'Chỉ chấp nhận files ảnh dưới 2Mb',

            ]);
            $file =$req ->file(('img'));
            $name = time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images');
            $file -> move($destinationPath, $name);
        }
        $this->validate($req,[
            'product_name'=>'required', 
            'description'=>'required', 
            'price'=>'required', 
            'version_id'=>'required',
            'service_id'=>'required',
        ],[
            'product_name.required' =>'Bạn chưa nhập mô tả',
            'description.required' =>'Bạn chưa nhập author',
            'price.required' =>'Bạn chưa nhập ngày sản xuất',
            'version_id.required' =>'Bạn chưa nhập ngày sản xuất',
            'service_id.required' =>'Bạn chưa nhập ngày sản xuất',
            'produced_on.required' =>'Bạn chưa nhập ngày sản xuất',
            'produced_on.date' =>'Cột produced_on phải là kiểu ngày!'
        ]);
        $product= Product::find($id);//Khac vs store()
        $product->product_name=$req->product_name;
        $product->description=$req->description;
        $product->price=$req->price;
        $product->version_id=$req->version_id;
        $product->service_id=$req->service_id;
        $product->img=$name;
        $product->save();

        return 'ok';
    }

    /**
     *
     */
    public function destroy($id)
    {
        //
    }
}
