<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class StatDevice extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'user_id',
        'device_type',
        'browser_family',
        'platform_family',
        'device_family',
        'device_type',
        'device_model',
        'come_from',
    ];
}
