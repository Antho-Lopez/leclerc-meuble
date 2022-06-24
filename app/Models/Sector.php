<?php

namespace App\Models;

use App\Models\Anomaly\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Sector extends Model
{
    use HasFactory, UsesTenantConnection;

    protected $connection = 'sectors';


    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' / ' . $this->leader->name. ' ' . $this->leader->firstname;
    }
}
