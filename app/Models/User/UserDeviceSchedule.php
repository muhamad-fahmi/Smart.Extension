<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeviceSchedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user_device()
    {
        return $this->belongsTo(UserDevice::class, 'user_device_id');
    }
}