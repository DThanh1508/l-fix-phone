<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Version;
use App\Models\Service;
use App\Models\Customer;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public function versions()
    {
        return $this-> belongsTo(Vesion::class,'version_id','id');
    }
    public function services()
    {
        return $this-> belongsTo(Service::class,'service_id','id');
    }
    public function customers()
    {
        return $this-> hasOne(Customer::class,'product_id','id');
    }
}
