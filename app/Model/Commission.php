<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commision_rate';

    protected $primaryKey = 'rate_id';

    protected $fillable = ['rate_percent', 'user_type'];
}
