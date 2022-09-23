<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class ProductType extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'type_id',
        'product_id'
    ];

    public $timestamps = false;

    protected $table = 'product_type';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
