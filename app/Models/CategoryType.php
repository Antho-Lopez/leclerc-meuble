<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class CategoryType extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'type_id',
        'category_id'
    ];

    public $timestamps = false;

    protected $table = 'category_type';

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
