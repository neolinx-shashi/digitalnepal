<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommissionRate extends Model
{
    protected $table = 'commission_rate';

    protected $primaryKey = 'rate_id';

    protected $fillable = ['rate_percent', 'user_type'];
}
