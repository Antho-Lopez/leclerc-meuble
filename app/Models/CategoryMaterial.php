<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class CategoryMaterial extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'material_id',
        'category_id'
    ];

    public $timestamps = false;

    protected $table = 'category_material';

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
