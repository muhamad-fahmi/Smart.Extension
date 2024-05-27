<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function device()
    {
        return $this->hasMany(Device::class, 'category_id');
    }
}