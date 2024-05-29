<?php

namespace App\Models\Admin;

use App\Models\User\UserDevice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(DeviceCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->hasMany(UserDevice::class, 'device_id');

   }

   public function device_sensor()
    {
        return $this->hasMany(DeviceSensor::class, 'device_id');
   }
}