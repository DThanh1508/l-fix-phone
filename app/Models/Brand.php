<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Version;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    public function versions()
    {
        return $this->hasMany(Version::class,'brand_id','id');
    }
}
