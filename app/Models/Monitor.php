<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $fillable = [
        'name',
        'url',
        'status',
        'last_response_time',
        'last_checked_at',
    ];
}
