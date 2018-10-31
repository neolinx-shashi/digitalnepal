<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallet';

    protected $primaryKey = 'wallet_id';

    protected $fillable = ['wallet_amount', 'wallet_from', 'wallet_to'];
}
