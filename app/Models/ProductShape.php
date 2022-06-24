<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class ProductShape extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'shape_id',
        'product_id',
    ];

    public $timestamps = false;

    protected $table = 'product_shape';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function shapes()
    {
        return $this->hasMany(Shape::class);
    }
}
