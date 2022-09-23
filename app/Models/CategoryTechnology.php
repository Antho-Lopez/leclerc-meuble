<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class CategoryTechnology extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'technology_id',
        'category_id'
    ];

    public $timestamps = false;

    protected $table = 'category_technology';

    public function technologies()
    {
        return $this->hasMany(Technology::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
