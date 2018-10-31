<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'stb_purchase';

    protected $primaryKey = 'purchase_id';

    protected $fillable = ['stb_id', 'user_id', 'seller_id', 'purchase_date', 'purchase_expire'];
}
