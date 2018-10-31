<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PackageChannel extends Model
{
    protected $table = 'package_channel';

    protected $primaryKey = 'pc_id';

    protected $fillable = ['package_id', 'channel_id'];
}
