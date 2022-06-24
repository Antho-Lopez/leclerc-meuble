<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class CategoryColor extends Model
{
    use HasFactory, SoftDeletes, UsesTenantConnection;

    protected $fillable = [
        'color_id',
        'category_id'
    ];

    public $timestamps = false;

    protected $table = 'category_color';

    public function colors()
    {
        return $this->hasMany(Color::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
