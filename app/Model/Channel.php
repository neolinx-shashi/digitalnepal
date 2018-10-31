<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table = 'channel';

    protected $primaryKey = 'channel_id';

    protected $fillable = ['channel_name', 'channel_type', 'channel_record', 'channel_finger', 'channel_grade', 'channel_preview', 'channel_acdata', 'channel_flag'];
}
