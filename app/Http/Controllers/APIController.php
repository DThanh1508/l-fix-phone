<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
// use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Version;
use App\Models\Service;
use App\Models\Admin;
use App\Models\Customer;

use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

    public function createProduct(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                "description"  => "required",
                "model" => "required",
                "produced_on"  => "required|date",
                'image' => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]
        );

        if ($validation->fails()) {
            $response = array('status' => 'error', 'errors' => $validation->errors()->toArray());
            return response()->json($response);
        }

        $name = '';
        // $request->validate([
        //     'title'=>'required',
        //     'description'=>'required',
        //     'image'=>'required|image'
        // ]);

        // try{
        //     $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
        //     Storage::disk('public')->putFileAs('product/image', $request->image,$imageName);
        //     Product::create($request->post()+['image'=>$imageName]);

        //     return response()->json([
        //         'message'=>'Product Created Successfully!!'
        //     ]);
        // }catch(\Exception $e){
        //     \Log::error($e->getMessage());
        //     return response()->json([
        //         'message'=>'Something goes wrong while creating a product!!'
        //     ],500);
        // }
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
}
