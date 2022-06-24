<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryMaterial;
use App\Models\Material;
use App\Models\MaterialProduct;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::orderBy('created_at', 'desc')->paginate(10);
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        $categories = Category::get();

        return view('materials.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $material = Material::create($data);

        $data_categories = $request->validate([
            'category_id' => 'array',
        ]);

        if(isset($data_categories['category_id'])){
            foreach($data_categories['category_id'] as $category_id){
                if($category_id != null){
                    CategoryMaterial::create([
                        'category_id' => $category_id,
                        'material_id' => $material['id'],
                    ]);
                }
            }
        }

        return redirect()->route('material.index')->with('success_message', 'Le matériau / revetement a bien été créé');
    }

    public function edit($id)
    {
        $material = Material::find($id);

        $categories = Category::get();
        $categories_material = CategoryMaterial::where('material_id', $id)->get();

        return view('materials.edit', compact('material', 'categories', 'categories_material'));
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'name' => 'required',
        ]);
        Material::where('id', $id)->update($data);

        $data_categories = $request->validate([
            'category_id' => 'array'
        ]);

        $categories_material = CategoryMaterial::where('material_id', $id)->get();
        $categories_material = $categories_material->pluck('category_id')->all();
        $categories = Category::get();
        $categories = $categories->pluck('id')->all();

        foreach($categories as $category){

            if(!empty($data_categories['category_id'])){
                if(in_array($category, $data_categories['category_id']) && !in_array($category, $categories_material)){

                    CategoryMaterial::create([
                        'material_id' => $id,
                        'category_id' => $category,
                    ]);
                } elseif(!in_array($category, $data_categories['category_id']) && in_array($category, $categories_material)) {

                    CategoryMaterial::where('category_id', $category)->where('material_id', $id)->delete();

                }
            } else {
                CategoryMaterial::where('category_id', $category)->where('material_id', $id)->delete();
            }
        }

        return redirect()->route('material.index')->with('success_message', 'Le matériau / revetement a bien été modifié');
    }

    public function delete($id)
    {
        Material::where('id', $id)->delete();
        MaterialProduct::where('material_id', $id)->delete();
        CategoryMaterial::where('material_id', $id)->delete();
        return redirect()->route('material.index')->with('success_message', 'Le matériau / revetement a bien été supprimé');

    }
}
