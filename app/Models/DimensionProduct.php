<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class DimensionProduct extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'dimension_id',
        'product_id'
    ];

    public $timestamps = false;

    protected $table = 'dimension_product';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function dimensions()
    {
        return $this->hasMany(Dimension::class);
    }
}
