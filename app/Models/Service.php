<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    public function products()
    {
        return $this-> hasMany(Product::class,'sevice_id','id');
    }
}
