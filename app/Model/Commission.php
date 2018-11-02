<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commission';

    protected $primaryKey = 'commission_id';

    protected $fillable = ['user_id', 'commission_amount', 'commission_from', 'purchase_id'];
}
