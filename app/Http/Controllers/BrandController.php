<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'desc')->paginate(10);
        return view('brands.index', compact('brands'));
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        return view('brands.show', compact('brand'));
    }

    public function create()
    {
        $categories = Category::get();

        return view('brands.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $brand = Brand::create($data);

        $data_categories = $request->validate([
            'category_id' => 'array',
        ]);

        if(isset($data_categories['category_id'])){
            foreach($data_categories['category_id'] as $category_id){
                if($category_id != null){
                    BrandCategory::create([
                        'category_id' => $category_id,
                        'brand_id' => $brand['id'],
                    ]);
                }
            }
        }

        return redirect()->route('brand.index')->with('success_message', "la Marque a bien été ajoutée");
    }

    public function edit($id)
    {
        $brand = Brand::where('id', $id)->find($id);

        $categories = Category::get();
        $brand_categories = BrandCategory::where('brand_id', $id)->get();

        return view('brands.edit', compact('brand', 'categories', 'brand_categories'));
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => 'required',
        ]);

        Brand::where('id', $id)->update($data);


        $data_categories = $request->validate([
            'category_id' => 'array'
        ]);

        $brand_category = BrandCategory::where('brand_id', $id)->get();
        $brand_category = $brand_category->pluck('category_id')->all();
        $categories = Category::get();
        $categories = $categories->pluck('id')->all();

        foreach($categories as $category){

            if(!empty($data_categories['category_id'])){
                if(in_array($category, $data_categories['category_id']) && !in_array($category, $brand_category)){

                    BrandCategory::create([
                        'brand_id' => $id,
                        'category_id' => $category,
                    ]);
                } elseif(!in_array($category, $data_categories['category_id']) && in_array($category, $brand_category)) {

                    BrandCategory::where('category_id', $category)->where('brand_id', $id)->delete();

                }
            } else {
                BrandCategory::where('category_id', $category)->where('color_id', $id)->delete();
            }

        }

        return redirect()->route('brand.index')->with('success_message', "la Marque a bien été modifiée");
    }

    public function delete($id)
    {
        Brand::where('id', $id)->delete();
        BrandCategory::where('brand_id', $id)->delete();
        return redirect()->route('brand.index')->with('success_message', 'La Marque a bien été supprimée');

    }

    public function jsondata()
    {
        return Brand::orderBy('id', 'desc')->get();
    }
}
