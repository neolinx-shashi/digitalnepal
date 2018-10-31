<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposit';

    protected $primaryKey = 'deposit_id';

    protected $fillable = ['deposit_amount', 'deposit_type', 'user_id'];
}
