<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryColor;
use App\Models\Color;
use App\Models\ColorProduct;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::orderBy('created_at', 'desc')->paginate(10);
        return view('colors.index', compact('colors'));
    }

    public function create()
    {
        $categories = Category::get();

        return view('colors.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'color_code' => 'required',
        ]);

        $color = Color::create($data);

        $data_categories = $request->validate([
            'category_id' => 'array',
        ]);

        if(isset($data_categories['category_id'])){
            foreach($data_categories['category_id'] as $category_id){
                if($category_id != null){
                    CategoryColor::create([
                        'category_id' => $category_id,
                        'color_id' => $color['id'],
                    ]);
                }
            }
        }

        return redirect()->route('color.index')->with('success_message', 'La couleur a bien été créée');
    }

    public function edit($id)
    {
        $color = Color::find($id);

        $categories = Category::get();
        $categories_color = CategoryColor::where('color_id', $id)->get();

        return view('colors.edit', compact('color', 'categories', 'categories_color'));
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'name' => 'required',
            'color_code' => 'required',
        ]);
        Color::where('id', $id)->update($data);

        $data_categories = $request->validate([
            'category_id' => 'array'
        ]);

        $categories_color = CategoryColor::where('color_id', $id)->get();
        $categories_color = $categories_color->pluck('category_id')->all();
        $categories = Category::get();
        $categories = $categories->pluck('id')->all();

        foreach($categories as $category){

            if(!empty($data_categories['category_id'])){
                if(in_array($category, $data_categories['category_id']) && !in_array($category, $categories_color)){

                    CategoryColor::create([
                        'color_id' => $id,
                        'category_id' => $category,
                    ]);
                } elseif(!in_array($category, $data_categories['category_id']) && in_array($category, $categories_color)) {

                    CategoryColor::where('category_id', $category)->where('color_id', $id)->delete();
                }
            } else {
                CategoryColor::where('category_id', $category)->where('color_id', $id)->delete();
            }
        }

        return redirect()->route('color.index')->with('success_message', 'La couleur a bien été modifiée');
    }

    public function delete($id)
    {
        Color::where('id', $id)->delete();
        CategoryColor::where('color_id', $id)->delete();
        ColorProduct::where('color_id', $id)->delete();
        return redirect()->route('color.index')->with('success_message', 'La couleur a bien été supprimée');

    }

    // public function jsondata()
    // {
    //     return Color::orderBy('id', 'desc')->get();
    // }
}
