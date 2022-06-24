<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class CategoryShape extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'shape_id',
        'category_id'
    ];

    public $timestamps = false;

    protected $table = 'category_shape';

    public function shapes()
    {
        return $this->hasMany(Shape::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
