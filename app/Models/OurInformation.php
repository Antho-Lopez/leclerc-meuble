<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class OurInformation extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $table = 'our_informations';

    protected $fillable = [
        'email',
        'phone',
        'address',
        'cp',
        'city',
    ];
}
