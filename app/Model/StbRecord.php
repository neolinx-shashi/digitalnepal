<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StbRecord extends Model
{
    protected $table = 'stb_record';

    protected $primaryKey = 'stb_id';

    protected $fillable = ['stb_no', 'user_id', 'stb_status', 'exec_date', 'start_date', 'expire_date'];
}
