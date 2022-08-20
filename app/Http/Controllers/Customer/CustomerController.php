<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::leftJoin('products', 'products.id', 'customers.product_id')
        ->select('products.product_name', 'customers.*')
        ->get();
        if ($customers) {
            return response()->json($customers, Response::HTTP_OK);
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
        $req->validate([
            'cus_name' =>'required',
            'cusphone_number'=>'required',
            'repair_day'=>'required', 
            'received_day'=>'required', 
            'phone_name'=>'required', 
            'phone_emei'=>'required',
            'model'=>'required',             
        ],[
            'cus_name.required' => 'Bạn chưa nhập họ tên',
            'phone_name.required' =>'Bạn chưa nhập tên điện thoại',
            'repair_day.required' =>'Bạn chưa ngày sửa',
            'received_day.required' =>'Bạn chưa nhập ngày nhận',
            'phone_emei.required' =>'Bạn chưa nhập số emei',
            'model.required' =>'Bạn chưa nhập model',
            'cusphone_number.required' =>'Bạn chưa nhập số điện thoại',
        ]);

        $cus = new Customer();
        $cus->cus_name=$req->cus_name;
        $cus->phone_name=$req->phone_name;
        $cus->repair_day=$req->repair_day;
        $cus->received_day=$req->received_day;
        $cus->phone_emei=$req->phone_emei;
        $cus->model=$req->model;
        $cus->cusphone_number=$req->cusphone_number;
        if (!empty($req->note)) $cus->note=$req->note;
        $cus->save();
        return response()->json($cus, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = Customer::find($id);
        return response()->json($customers);
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
        $customers = Customer::find($id);
        //Xoa luon anh trong thu muc, neu ko co cau lenh nay thi khi xoa anh van con trong thu muc
        // if (File::exists($linkImage)) {
        //     File::delete($linkImage);
        // }
        $customers->delete();
        return 2;
    }
}
