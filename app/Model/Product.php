<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "tc_product";
    protected $primaryKey = 'product_id';
    protected $fillable = ["product_id", "product_name", "status", "provider_id"];
}
