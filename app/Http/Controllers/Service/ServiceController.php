<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getAllServices() {
        return Service::get();
    }
    public function getProductsByServiceId($id) {
        return Product::where("service_id", $id)->get();
    }
}
