<?php

namespace App\Http\Controllers;

use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\CategoryColor;
use App\Models\CategoryMaterial;
use App\Models\CategoryShape;
use App\Models\ProductSubcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        $subcategories = Subcategory::get();

        return view('categories.index', compact('categories', 'subcategories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'img_name' => 'required',
        ]);

        $filename = time() . '.' . $request->img_name->extension();

        $data['img_name'] = $request->file('img_name')->storeAs(
            $data['name'],
            $filename,
            'public'
        );
        $miniature = Image::make($request->file('img_name'));
        $miniature->resize(null, 100, function($constraint) {
            $constraint->aspectRatio();
        });
        $img_path = public_path('storage/' . $data['name'] . '/' .'miniature'. '-' . $filename);
        $miniature->save($img_path, 80);

        $category = Category::create($data);

        CategoryColor::create([
            'category_id' => $category['id'],
            'color_id' => 1,
        ]);

        $data2 = $request->validate([
            'subname' => 'array',
        ]);

        $subnames = $request->input('subname');

        if(!empty($data2)){
            foreach($subnames as $subname){

                Subcategory::create([
                    'category_id' => $category['id'],
                    'subname' => $subname,
                ]);
            }
        }

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = Category::with('subcategories')->find($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'name' => 'required',
            'img_name' => 'nullable',
        ]);

        if(isset($data['img_name'])){
            $filename = time() . '.' . $request->img_name->extension();
            $data['img_name'] = $request->file('img_name')->storeAs(
                $data['name'],
                $filename,
                'public'
            );
            $miniature = Image::make($request->file('img_name'));
            $miniature->resize(null, 100, function($constraint) {
                $constraint->aspectRatio();
            });
            $img_path = public_path('storage/' . $data['name'] . '/' .'miniature'. '-' . $filename);
            $miniature->save($img_path, 80);
        }

        Category::where('id', $id)->update($data);

        $category = Category::where('id', $id)->get('id');

        $data2 = $request->validate([
            'existing_subnames' => 'array',
            'id' => 'array',
            'deleted_at' => 'array',
        ]);

        $existing_subnames = $request->input('existing_subnames');
        $count = 0;

        if(!empty($data2)){
            foreach($existing_subnames as $existing_subname){

                Subcategory::where('id', $data2['id'][$count])->update([
                    'category_id' => $category[0]->id,
                    'subname' => $existing_subname,
                ]);
                $count++;
            }
        }

        $deleted_at = $request->input('deleted_at');
        $count_delete = 0;

        if(!empty($data2['deleted_at'])){
            foreach($deleted_at as $deleted){

                Subcategory::where('id', $data2['deleted_at'][$count_delete])->delete();
                ProductSubcategory::where('subcategory_id', $data2['deleted_at'][$count_delete])->delete();
                $count_delete++;
            }
        }

        $data3 = $request->validate([
            'new_subnames' => 'array',
        ]);

        $new_subnames = $request->input('new_subnames');

        if(!empty($data3)){
            foreach($new_subnames as $new_subname){

                Subcategory::create([
                    'category_id' => $category[0]->id,
                    'subname' => $new_subname,
                ]);
            }
        }

        return redirect()->route('category.index')->with('success_message', 'La catégorie a bien été modifiée');
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
        BrandCategory::where('category_id', $id)->delete();
        CategoryColor::where('category_id', $id)->delete();
        CategoryShape::where('category_id', $id)->delete();
        CategoryMaterial::where('category_id', $id)->delete();

        return redirect()->route('category.index')->with('success_message', 'La catégorie a bien été supprimée');

    }

    public function jsondata()
    {
        return Category::orderBy('id', 'desc')->with('subcategories')->get();
    }

}
