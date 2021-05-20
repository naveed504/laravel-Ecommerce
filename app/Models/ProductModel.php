<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttribute;

class ProductModel extends Model
{
    use HasFactory;
    protected $table= 'products';
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class,'product_id');
    }

}
