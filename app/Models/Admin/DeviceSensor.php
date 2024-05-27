<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceSensor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class, 'sensor_id');
    }
}