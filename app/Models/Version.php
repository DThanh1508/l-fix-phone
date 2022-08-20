<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Product;

class Version extends Model
{
    use HasFactory;
    protected $table = 'versions';
    public function brands()
    {
        return $this -> belongsTo(Brand::class,'brand_id','id');
    }
    public function products()
    {
        return $this-> hasMany(Product::class,'version_id','id');
    }
}
