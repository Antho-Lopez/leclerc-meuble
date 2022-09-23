<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\ProductType;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::orderBy('created_at', 'desc')->paginate(10);
        return view('types.index', compact('types'));
    }

    public function create()
    {
        $categories = Category::get();

        return view('types.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $type = Type::create($data);

        $data_categories = $request->validate([
            'category_id' => 'array',
        ]);

        if(isset($data_categories['category_id'])){
            foreach($data_categories['category_id'] as $category_id){
                if($category_id != null){
                    CategoryType::create([
                        'category_id' => $category_id,
                        'type_id' => $type['id'],
                    ]);
                }
            }
        }

        return redirect()->route('type.index')->with('success_message', 'Le type de produit a bien été créé');
    }

    public function edit($id)
    {
        $type = Type::find($id);

        $categories = Category::get();
        $categories_type = CategoryType::where('type_id', $id)->get();

        return view('types.edit', compact('type', 'categories', 'categories_type'));
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'name' => 'required',
        ]);
        Type::where('id', $id)->update($data);

        $data_categories = $request->validate([
            'category_id' => 'array'
        ]);

        $categories_type = CategoryType::where('type_id', $id)->get();
        $categories_type = $categories_type->pluck('category_id')->all();
        $categories = Category::get();
        $categories = $categories->pluck('id')->all();

        foreach($categories as $category){

            if(!empty($data_categories['category_id'])){
                if(in_array($category, $data_categories['category_id']) && !in_array($category, $categories_type)){

                    CategoryType::create([
                        'type_id' => $id,
                        'category_id' => $category,
                    ]);
                } elseif(!in_array($category, $data_categories['category_id']) && in_array($category, $categories_type)) {

                    CategoryType::where('category_id', $category)->where('type_id', $id)->delete();

                }
            } else {
                CategoryType::where('category_id', $category)->where('type_id', $id)->delete();
            }
        }

        return redirect()->route('type.index')->with('success_message', 'Le type de produit a bien été modifié');
    }

    public function delete($id)
    {
        Type::where('id', $id)->delete();
        ProductType::where('type_id', $id)->delete();
        CategoryType::where('type_id', $id)->delete();
        return redirect()->route('type.index')->with('success_message', 'Le type de produit a bien été supprimé');

    }
}
