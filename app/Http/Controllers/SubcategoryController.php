<?php

namespace App\Http\Controllers;

use App\Models\ProductSubcategory;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function jsondata($id)
    {
        return [ProductSubcategory::get() ,Subcategory::where('category_id', $id)->orderBy('id', 'desc')->get()];
    }
}
