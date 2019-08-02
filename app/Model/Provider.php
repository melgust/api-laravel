<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public $table = "tc_provider";
    protected $primaryKey = 'provider_id';
    protected $fillable = ["provider_id", "provider_name", "status"];
}
