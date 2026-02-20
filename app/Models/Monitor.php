<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'host',
        'port',
        'protocol',
        'is_active',
        'expected_status_code',
        'timeout',
        'auth_type',
        'headers',
        'body',
    ];

    protected $casts = [
        'headers' => 'array',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checks()
    {
        return $this->hasMany(MonitorCheck::class);
    }

    public function results()
    {
        return $this->hasMany(MonitorResult::class);
    }
}
