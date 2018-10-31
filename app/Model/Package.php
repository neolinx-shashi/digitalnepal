<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

    protected $primaryKey = 'package_id';

    protected $fillable = ['package_name', 'package_price', 'package_activeprice', 'package_sage', 'package_order', 'package_status', 'package_autoactive'];
}
