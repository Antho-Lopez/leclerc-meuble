<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class ProductTechnology extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'technology_id',
        'product_id'
    ];

    public $timestamps = false;

    protected $table = 'product_technology';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function technologies()
    {
        return $this->hasMany(Technology::class);
    }
}
