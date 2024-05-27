<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function devices()
    {
        return $this->hasMany(DeviceSensor::class, 'device_id');
    }

    public function params()
    {
        return $this->hasMany(SensorParameter::class, 'sensor_id');
    }

}