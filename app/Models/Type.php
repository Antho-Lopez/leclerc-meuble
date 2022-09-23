<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Type extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'name',
    ];
}
