<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Stb extends Model
{
    protected $table = 'stb';

    protected $primaryKey = 'stb_id';

    protected $fillable = ['stb_number' ,'stb_status'];
}
