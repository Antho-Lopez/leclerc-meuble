<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Product extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;


    protected $fillable = [
        'name',
        'category_id',
        'inspiration_id',
        'description',
        'details',
        'price',
        'brand_id',
        'production',
        'nb_in_list',
    ];

    protected $with = ['category', 'inspiration', 'brand', 'img_products'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inspiration()
    {
        return $this->belongsTo(Inspiration::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function img_products()
    {
        return $this->hasMany(ImgProduct::class);
    }
}
