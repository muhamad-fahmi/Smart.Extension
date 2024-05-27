<?php

namespace App\Models\User;

use App\Models\Admin\Device;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function schedule()
    {
        return $this->hasMany(UserDeviceSchedule::class, 'user_device_id');
    }
}
