<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class MaterialProduct extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'material_id',
        'product_id'
    ];

    public $timestamps = false;

    protected $table = 'material_product';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
