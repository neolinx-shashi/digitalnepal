<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';

    protected $primaryKey = 'price_id';

    protected $fillable = ['price_amount', 'price_type'];
}
