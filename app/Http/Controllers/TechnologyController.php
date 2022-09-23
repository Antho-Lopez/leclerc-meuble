<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Models\CategoryTechnology;
use App\Models\ProductTechnology;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::orderBy('created_at', 'desc')->paginate(10);
        return view('technologies.index', compact('technologies'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('technologies.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $technology = Technology::create($data);

        $data_categories = $request->validate([
            'category_id' => 'array',
        ]);

        if(isset($data_categories['category_id'])){
            foreach($data_categories['category_id'] as $category_id){
                if($category_id != null){
                    CategoryTechnology::create([
                        'category_id' => $category_id,
                        'technology_id' => $technology['id'],
                    ]);
                }
            }
        }

        return redirect()->route('technology.index')->with('success_message', 'Le type de technologie a bien été créé');
    }

    public function edit($id)
    {
        $technology = Technology::find($id);

        $categories = Category::get();
        $categories_technology = CategoryTechnology::where('technology_id', $id)->get();

        return view('technologies.edit', compact('technology', 'categories', 'categories_technology'));
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'name' => 'required',
        ]);
        Technology::where('id', $id)->update($data);

        $data_categories = $request->validate([
            'category_id' => 'array'
        ]);

        $categories_technology = CategoryTechnology::where('technology_id', $id)->get();
        $categories_technology = $categories_technology->pluck('category_id')->all();
        $categories = Category::get();
        $categories = $categories->pluck('id')->all();

        foreach($categories as $category){

            if(!empty($data_categories['category_id'])){
                if(in_array($category, $data_categories['category_id']) && !in_array($category, $categories_technology)){

                    CategoryTechnology::create([
                        'technology_id' => $id,
                        'category_id' => $category,
                    ]);
                } elseif(!in_array($category, $data_categories['category_id']) && in_array($category, $categories_technology)) {

                    CategoryTechnology::where('category_id', $category)->where('technology_id', $id)->delete();

                }
            } else {
                CategoryTechnology::where('category_id', $category)->where('technology_id', $id)->delete();
            }
        }

        return redirect()->route('technology.index')->with('success_message', 'Le type de technologie a bien été modifié');
    }

    public function delete($id)
    {
        Technology::where('id', $id)->delete();
        ProductTechnology::where('technology_id', $id)->delete();
        CategoryTechnology::where('technology_id', $id)->delete();
        return redirect()->route('technology.index')->with('success_message', 'Le type de technologie a bien été supprimé');

    }
}
