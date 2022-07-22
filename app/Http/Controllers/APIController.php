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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     *
     */
    public function destroy($id)
    {
        //
    }
}
