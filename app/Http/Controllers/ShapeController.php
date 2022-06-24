<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryShape;
use App\Models\ProductShape;
use App\Models\Shape;
use Illuminate\Http\Request;

class ShapeController extends Controller
{
    public function index()
    {
        $shapes = Shape::orderBy('created_at', 'desc')->paginate(10);
        return view('shapes.index', compact('shapes'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('shapes.create', compact('categories'));
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

        // dd($data);

        $shape = Shape::create($data);

        $data_categories = $request->validate([
            'category_id' => 'array',
        ]);

        if(isset($data_categories['category_id'])){
            foreach($data_categories['category_id'] as $category_id){
                if($category_id != null){
                    CategoryShape::create([
                        'category_id' => $category_id,
                        'shape_id' => $shape['id'],
                    ]);
                }
            }
        }
        return redirect()->route('shape.index')->with('success_message', "la forme a bien été ajoutée");
    }

    public function edit($id)
    {
        $shape = Shape::find($id);

        $categories = Category::get();
        $categories_shape = CategoryShape::where('shape_id', $id)->get();

        return view('shapes.edit', compact('shape', 'categories', 'categories_shape'));
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
        }

        Shape::where('id', $id)->update($data);

        $data_categories = $request->validate([
            'category_id' => 'array'
        ]);

        $categories_shape = CategoryShape::where('shape_id', $id)->get();
        $categories_shape = $categories_shape->pluck('category_id')->all();
        $categories = Category::get();
        $categories = $categories->pluck('id')->all();

        foreach($categories as $category){

            if(!empty($data_categories['category_id'])){
                if(in_array($category, $data_categories['category_id']) && !in_array($category, $categories_shape)){

                    CategoryShape::create([
                        'shape_id' => $id,
                        'category_id' => $category,
                    ]);
                } elseif(!in_array($category, $data_categories['category_id']) && in_array($category, $categories_shape)) {

                    CategoryShape::where('category_id', $category)->where('shape_id', $id)->delete();

                }
            } else {
                CategoryShape::where('category_id', $category)->where('shape_id', $id)->delete();
            }
        }

        return redirect()->route('shape.index')->with('success_message', 'La forme a bien été modifiée');
    }

    public function delete($id)
    {
        Shape::where('id', $id)->delete();
        ProductShape::where('shape_id', $id)->delete();
        CategoryShape::where('shape_id', $id)->delete();
        return redirect()->route('shape.index')->with('success_message', 'La forme a bien été supprimée');
        
    }
}
