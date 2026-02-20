<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitorCheck extends Model
{
    protected $fillable = [
        'monitor_id',
        'check_type',
        'interval',
        'retry_count',
        'alert_threshold',
        'enabled',
    ];

    public function monitor()
    {
        return $this->belongsTo(Monitor::class);
    }
}
