<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = "tc_client";
    protected $primaryKey = 'client_id';
    protected $fillable = ["client_id", "client_name", "address", "nit", "status"];
}
