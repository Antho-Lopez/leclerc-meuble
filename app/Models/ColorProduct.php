<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class ColorProduct extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'color_id',
        'product_id',
    ];

    public $timestamps = false;

    protected $table = 'color_product';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function colors()
    {
        return $this->hasMany(Color::class);
    }
}
