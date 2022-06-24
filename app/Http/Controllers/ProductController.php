<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\CategoryColor;
use App\Models\CategoryMaterial;
use App\Models\CategoryShape;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Dimension;
use App\Models\DimensionProduct;
use App\Models\ImgGlobal;
use App\Models\ImgProduct;
use App\Models\Inspiration;
use App\Models\Material;
use App\Models\MaterialProduct;
use App\Models\OurInformation;
use App\Models\Product;
use App\Models\ProductShape;
use App\Models\ProductSubcategory;
use App\Models\ProductUser;
use App\Models\Shape;
use App\Models\SocialMedia;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    protected $query;

    public function index()
    {
        return view('products.index');
    }

    public function show($id)
    {
        $product = Product::find($id);

        $colors = ColorProduct::where('product_id', $id)->get('color_id');
        $colors_product = [];

        if(count($colors) > 0){
            foreach($colors as $color_product){
                $test = Color::where('id', $color_product->color_id)->get('color_code');
                array_push($colors_product, $test[0]->color_code);
            };
        };
        // dd($colors_product);

        $materials = MaterialProduct::where('product_id', $id)->get('material_id');
        $materials_product = [];

        if(count($materials) > 0){
            foreach($materials as $material_product){
                $test = Material::where('id', $material_product->material_id)->get('name');
                array_push($materials_product, $test[0]->name);
            };
        };

        $shapes = ProductShape::where('product_id', $id)->get('shape_id');
        $shapes_product = [];

        if(count($shapes) > 0){
            foreach($shapes as $shape_product){
                $test = Shape::where('id', $shape_product->shape_id)->get('name');
                array_push($shapes_product, $test[0]->name);
            };
        };

        $dimensions = DimensionProduct::where('product_id', $id)->get('dimension_id');
        $dimensions_product = [];

        if(count($dimensions) > 0){
            foreach($dimensions as $dimension_product){
                $test = Dimension::where('id', $dimension_product->dimension_id)->get('size');
                array_push($dimensions_product, $test[0]->size);
            };
        };

        $subcategories = ProductSubcategory::where('product_id', $id)->get('subcategory_id');
        $product_subcategories = [];

        if(count($subcategories) > 0){
            foreach($subcategories as $product_subcategory){
                $test = Subcategory::where('id', $product_subcategory->subcategory_id)->get('subname');
                array_push($product_subcategories, $test[0]->subname);
            };
        };

        return view('products.show', compact('product', 'colors_product', 'materials_product', 'shapes_product', 'dimensions_product', 'product_subcategories'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->get();
        $inspirations = Inspiration::get();
        $brands = Brand::get();
        $colors = Color::get();
        $materials = Material::get();
        $shapes = Shape::get();
        $dimensions = Dimension::get();

        return view('products.create', compact('categories', 'inspirations', 'brands', 'colors', 'materials', 'shapes', 'dimensions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'inspiration_id' => 'nullable',
            'description' => 'nullable',
            'details' => 'nullable',
            'price' => 'nullable',
            'brand_id' => 'nullable',
            'production' => 'nullable',
            'img_product' => 'array',
            'nb_in_list' => 'nullable',
        ]);

        $product = Product::create($data);

        $data_filters = $request->validate([
            'color_id' => 'array',
            'material_id' => 'array',
            'shape_id' => 'array',
            'dimension_id' => 'array',
            'subcategory_id' => 'array'
        ]);


        if(isset($data_filters['color_id'])){
            foreach($data_filters['color_id'] as $color_id){
                if($color_id != null){
                    ColorProduct::create([
                        'color_id' => $color_id,
                        'product_id' => $product['id'],
                    ]);
                }
            }
        }

        if(isset($data_filters['material_id'])){
            foreach($data_filters['material_id'] as $material_id){
                if($material_id != null){
                    MaterialProduct::create([
                        'material_id' => $material_id,
                        'product_id' => $product['id'],
                    ]);
                }
            }
        }

        if(isset($data_filters['shape_id'])){
            foreach($data_filters['shape_id'] as $shape_id){
                if($shape_id != null){
                    ProductShape::create([
                        'shape_id' => $shape_id,
                        'product_id' => $product['id'],
                    ]);
                }
            }
        }

        if(isset($data_filters['dimension_id'])){
            foreach($data_filters['dimension_id'] as $dimension_id){
                if($dimension_id != null){
                    DimensionProduct::create([
                        'dimension_id' => $dimension_id,
                        'product_id' => $product['id'],
                    ]);
                }
            }
        }

        if(isset($data_filters['subcategory_id'])){
            foreach($data_filters['subcategory_id'] as $subcategory_id){
                if($subcategory_id != null){
                    ProductSubcategory::create([
                        'subcategory_id' => $subcategory_id,
                        'product_id' => $product['id'],
                    ]);
                }
            }
        }

        if(isset($data['img_product'])){

            foreach($data['img_product'] as $key => $uploadedFile) {

                if(exif_imagetype($uploadedFile) == 2 || exif_imagetype($uploadedFile) == 3){
                    if($key == 0){
                        $file = $product->img_products()->create([
                            'product_id' => $product->id,
                            'img_name' => $uploadedFile->getClientOriginalName(),
                            'is_first' => 1,
                        ]);
                    } else {
                        $file = $product->img_products()->create([
                            'product_id' => $product->id,
                            'img_name' => $uploadedFile->getClientOriginalName(),
                            'is_first' => 0,
                        ]);
                    }
                    $uploadedFile->storeAs('product/' . $product->id, $file->id . '-' . $uploadedFile->getClientOriginalName(), 'public');
                    $miniature = Image::make($uploadedFile);
                    $miniature->resize(null, 590, function($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img_path = public_path('storage/product/'. $product->id . '/' . $file->id . '-' .'miniature'.'-' . $uploadedFile->getClientOriginalName());
                    $miniature->save($img_path, 80);
                }
            }
        }
        return redirect()->route('product.index')->with('success_message', 'Le produit a bien été créé');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->find($id);
        $category = Category::where('id', $product->category_id)->get();
        $inspirations = Inspiration::get();
        $brands = Brand::get();
        $colors = Color::get();
        $materials = Material::get();
        $shapes = Shape::get();
        $colors_product = ColorProduct::where('product_id', $id)->get();
        $materials_product = MaterialProduct::where('product_id', $id)->get();
        $shapes_product = ProductShape::where('product_id', $id)->get();
        $dimensions = Dimension::get();
        $dimensions_product = DimensionProduct::where('product_id', $id)->get();
        $subcategories = Subcategory::where('category_id', $product->category_id)->get();
        $product_subcategories = ProductSubcategory::where('product_id', $id)->get();

        return view('products.edit', compact('product', 'category', 'inspirations', 'brands', 'colors', 'materials', 'shapes', 'colors_product', 'materials_product', 'shapes_product', 'dimensions', 'dimensions_product', 'subcategories', 'product_subcategories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'inspiration_id' => 'nullable',
            'description' => 'nullable',
            'details' => 'nullable',
            'price' => 'nullable',
            'brand_id' => 'nullable',
            'production' => 'nullable',
            'nb_in_list' => 'nullable'
        ]);

        Product::where('id', $id)->update($data);

        $data_filters = $request->validate([
            'color_id' => 'array',
            'material_id' => 'array',
            'shape_id' => 'array',
            'dimension_id' => 'array',
            'subcategory_id' => 'array'
        ]);

        $color_product = ColorProduct::where('product_id', $id)->get();
        $color_product = $color_product->pluck('color_id')->all();
        $colors = Color::get();
        $colors = $colors->pluck('id')->all();

        foreach($colors as $color){

            if(!empty($data_filters['color_id'])){
                if(in_array($color, $data_filters['color_id']) && !in_array($color, $color_product)){

                    ColorProduct::create([
                        'color_id' => $color,
                        'product_id' => $id,
                    ]);
                } elseif(!in_array($color, $data_filters['color_id']) && in_array($color, $color_product)) {

                    ColorProduct::where('color_id', $color)->where('product_id', $id)->delete();
                }
            } else {
                ColorProduct::where('color_id', $color)->where('product_id', $id)->delete();
            }

        }

        $material_product = MaterialProduct::where('product_id', $id)->get();
        $material_product = $material_product->pluck('material_id')->all();
        $materials = Material::get();
        $materials = $materials->pluck('id')->all();

        foreach($materials as $material){

            if(!empty($data_filters['material_id'])){
                if(in_array($material, $data_filters['material_id']) && !in_array($material, $material_product)){

                    MaterialProduct::create([
                        'material_id' => $material,
                        'product_id' => $id,
                    ]);
                } elseif(!in_array($material, $data_filters['material_id']) && in_array($material, $material_product)) {

                    MaterialProduct::where('material_id', $material)->where('product_id', $id)->delete();

                }
            } else {
                MaterialProduct::where('material_id', $material)->where('product_id', $id)->delete();
            }

        }

        $shape_product = ProductShape::where('product_id', $id)->get();
        $shape_product = $shape_product->pluck('shape_id')->all();
        $shapes = Shape::get();
        $shapes = $shapes->pluck('id')->all();

        foreach($shapes as $shape){

            if(!empty($data_filters['shape_id'])){
                if(in_array($shape, $data_filters['shape_id']) && !in_array($shape, $shape_product)){

                    ProductShape::create([
                        'shape_id' => $shape,
                        'product_id' => $id,
                    ]);
                } elseif(!in_array($shape, $data_filters['shape_id']) && in_array($shape, $shape_product)) {

                    ProductShape::where('shape_id', $shape)->where('product_id', $id)->delete();

                }
            } else {
                ProductShape::where('shape_id', $shape)->where('product_id', $id)->delete();
            }

        }

        $dimension_product = DimensionProduct::where('product_id', $id)->get();
        $dimension_product = $dimension_product->pluck('dimension_id')->all();
        $dimensions = Dimension::get();
        $dimensions = $dimensions->pluck('id')->all();


        foreach($dimensions as $dimension){

            if(!empty($data_filters['dimension_id'])){
                if(in_array($dimension, $data_filters['dimension_id']) && !in_array($dimension, $dimension_product)){

                    DimensionProduct::create([
                        'dimension_id' => $dimension,
                        'product_id' => $id,
                    ]);
                } elseif(!in_array($dimension, $data_filters['dimension_id']) && in_array($dimension, $dimension_product)) {

                    DimensionProduct::where('dimension_id', $dimension)->where('product_id', $id)->delete();

                }
            } else {
                DimensionProduct::where('dimension_id', $dimension)->where('product_id', $id)->delete();
            }

        }

        $product_subcategory = ProductSubcategory::where('product_id', $id)->get();
        $product_subcategory = $product_subcategory->pluck('subcategory_id')->all();
        $subcategories = Subcategory::get();
        $subcategories = $subcategories->pluck('id')->all();


        foreach($subcategories as $subcategory){

            if(!empty($data_filters['subcategory_id'])){
                if(in_array($subcategory, $data_filters['subcategory_id']) && !in_array($subcategory, $product_subcategory)){

                    ProductSubcategory::create([
                        'subcategory_id' => $subcategory,
                        'product_id' => $id,
                    ]);
                } elseif(!in_array($subcategory, $data_filters['subcategory_id']) && in_array($subcategory, $product_subcategory)) {

                    ProductSubcategory::where('subcategory_id', $subcategory)->where('product_id', $id)->delete();
                }
            } else {
                ProductSubcategory::where('subcategory_id', $subcategory)->where('product_id', $id)->delete();
            }
        }

        $data_files = $request->validate([
            'filename_delete' => 'nullable|array',
        ]);

        if(!empty($data_files['filename_delete'])){

            ImgProduct::whereIn('id', $data_files['filename_delete'])->delete();
        }

        $product = Product::where('id', $id)->find($id);

        $data_files = $request->validate([
            'img_product' => 'array',
        ]);

        $already_have_first = ImgProduct::where('product_id', $product->id)->where('is_first', 1)->get();

        if(isset($data_files['img_product'])){

            foreach($data_files['img_product'] as $key => $uploadedFile) {

                if($key == 0 && count($already_have_first) == 0){
                    $file = $product->img_products()->create([
                        'product_id' => $product->id,
                        'img_name' => $uploadedFile->getClientOriginalName(),
                        'is_first' => 1,
                    ]);

                } else {
                    $file = $product->img_products()->create([
                        'product_id' => $product->id,
                        'img_name' => $uploadedFile->getClientOriginalName(),
                        'is_first' => 0,
                    ]);
                }

                $uploadedFile->storeAs('product/' . $product->id, $file->id . '-' . $uploadedFile->getClientOriginalName(), 'public');

                $miniature = Image::make($uploadedFile);
                $miniature->resize(null, 590, function($constraint) {
                    $constraint->aspectRatio();
                });
                $img_path = public_path('storage/product/'. $product->id . '/' . $file->id . '-' .'miniature'.'-' . $uploadedFile->getClientOriginalName());
                $miniature->save($img_path, 80);
            }
        }

        return redirect()->route('product.index')->with('success_message', 'Le produit a bien été modifié');
    }


    public function delete($id)
    {
        Product::where('id', $id)->delete();
        ColorProduct::where('product_id', $id)->delete();
        MaterialProduct::where('product_id', $id)->delete();
        DimensionProduct::where('product_id', $id)->delete();
        ProductShape::where('product_id', $id)->delete();
        ProductSubcategory::where('product_id', $id)->delete();
        ProductUser::where('product_id', $id)->delete();
        ImgProduct::where('product_id', $id)->delete();

        return redirect()->route('product.index')->with('success_message', 'Le produit a bien été supprimé');
    }

    public function downloadFile($product_id, $id)
    {
        $file = ImgProduct::where('product_id', $product_id)->findOrFail($id);
        return Storage::download('product/' . $product_id . '/' . $file->id . '-' . $file->img_name, $file->img_name);
    }

    public function displayImage($product_id , $id)
    {
        $file = ImgProduct::where('product_id', $product_id)->findOrFail($id);
        return Storage::get('product/' . $product_id . '/' . $file->id . '-' . $file->img_name, $file->img_name);
    }

    public function manage_first($id, $img_id)
    {
        ImgProduct::where('product_id', $id)->where('is_first', 1)->update(['is_first' => 0]);
        ImgProduct::where('id', $img_id)->update(['is_first' => 1]);
        return redirect()->route('product.show', $id)->with('success_message', "l'image en favoris a bien été modifiée");
    }

    public function add_fav($id, $auth_id)
    {
        ProductUser::where('user_id', $auth_id)->where('product_id', $id)->create([
            'user_id' => $auth_id,
            'product_id' => $id
        ]);

       /* Getting the previous url and getting the id from the url. */
        $product = Product::where('id', $id)->find($id);
        $url = url()->previous();
        $pos = strrpos($url, '/');
        $previous_id = $pos === false ? $url : substr($url, $pos + 1);
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        if($route == 'oneproduct') {
            return redirect()->route('oneproduct', $previous_id)->with('success_message', "le produit à bien été ajouté dans votre liste");
        }  elseif ($route == 'products') {
            return redirect()->route('products', $previous_id)->with('success_message', "le produit à bien été ajouté dans votre liste");
        } else {
            return redirect()->route('collectionproducts', $product->inspiration_id)->with('success_message', "le produit à bien été ajouté dans     votre liste");
        }
    }

    public function remove_fav($id, $auth_id)
    {
        ProductUser::where('user_id', $auth_id)->where('product_id', $id)->delete();
        Product::where('id', $id)->find($id);

        $url = url()->previous();
        $pos = strrpos($url, '/');
        $previous_id = $pos === false ? $url : substr($url, $pos + 1);
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        return redirect()->route($route, $previous_id)->with('success_message', "le produit à bien été retiré de votre liste");
    }

    public function displayFront($id)
    {
        $products = Product::where('category_id', $id)->with('img_products')->paginate(15);
        $logo = ImgGlobal::find(1);
        $contact = OurInformation::find(1);
        $socials = SocialMedia::get();
        $categories = Category::get();
        $current_category = Category::where('id', $id)->find($id);
        $inspirations = Inspiration::where('id', '!=' , 1)->orderBy('created_at', 'desc')->limit(6)->get();

        return view('frontproducts', compact('current_category', 'products', 'logo', 'contact', 'socials', 'categories', 'inspirations'));

    }

    public function displayFrontOne($id)
    {
        $product = Product::find($id);
        $logo = ImgGlobal::find(1);
        $contact = OurInformation::find(1);
        $socials = SocialMedia::get();
        $categories = Category::get();
        $inspirations = Inspiration::where('id', '!=' , 1)->orderBy('created_at', 'desc')->limit(6)->get();

        return view('oneproduct', compact('product', 'logo', 'contact', 'socials', 'categories', 'inspirations'));
    }

    public function fav($id)
    {
        $logo = ImgGlobal::find(1);
        $fav_collections = Inspiration::where('is_favorite', 1)->get();
        $contact = OurInformation::find(1);
        $socials = SocialMedia::get();
        $categories = Category::get();
        $inspirations = Inspiration::where('id', '!=' , 1)->orderBy('created_at', 'desc')->limit(6)->get();

        $get_products = ProductUser::where('user_id', $id)->get('product_id');
        $products = Product::whereIn('id', $get_products)->get();

        if(Auth::user()->id == $id){
            return view('myfav', compact('logo', 'fav_collections', 'contact', 'socials', 'categories', 'inspirations', 'products'));
        }
        else {
            return 'Error 404';
        }
    }

    public function oneProductDatas($id)
    {
        $product = Product::find($id);

        $subcategories = ProductSubcategory::where('product_id', $id)->get('subcategory_id');
        $product_subcategories = [];

        foreach($subcategories as $product_subcategory){
            $test = Subcategory::where('id', $product_subcategory->subcategory_id)->get('subname');
            array_push($product_subcategories, $test[0]->subname);
        };

        $same_subcategories = ProductSubcategory::whereIn('subcategory_id', $subcategories)->where('product_id', '!=', $id)->get('product_id');
        $suggestions1 = Product::whereIn('id', $same_subcategories)->orderBy('created_at', 'desc')->limit(6)->get();

        if(count($suggestions1) < 6){
            $suggestions1 = Product::where('category_id', $product->category_id)->orderBy('created_at', 'desc')->limit(6)->get();
        }

        $get_colors = ColorProduct::where('product_id', $id)->get('color_id');
        $colors = Color::whereIn('id', $get_colors)->get('name');

        $get_materials = MaterialProduct::where('product_id', $id)->get('material_id');
        $materials = Material::whereIn('id', $get_materials)->get('name');

        $get_shapes = ProductShape::where('product_id', $id)->get('shape_id');
        $shapes = Shape::whereIn('id', $get_shapes)->get('name');

        if($product->category_id == 1){

            $get_dimensions = DimensionProduct::where('product_id', $id)->get('dimension_id');
            $dimensions = Dimension::whereIn('id', $get_dimensions)->get('size');

            return [$product ,$suggestions1, $colors, $materials, $product_subcategories, $shapes, $dimensions];
        }

        return [$product ,$suggestions1, $colors, $materials, $product_subcategories, $shapes];
    }

    public function filters($category_id)
    {

        $get_colors = CategoryColor::where('category_id', $category_id)->get('color_id');
        $colors = Color::whereIn('id', $get_colors)->get();

        $get_materials = CategoryMaterial::where('category_id', $category_id)->get('material_id');
        $materials = Material::whereIn('id', $get_materials)->get();

        $get_shapes = CategoryShape::where('category_id', $category_id)->get('shape_id');
        $shapes = Shape::whereIn('id', $get_shapes)->get();

        $get_brands = BrandCategory::where('category_id', $category_id)->get('brand_id');
        $brands = Brand::whereIn('id', $get_brands)->get();

        return [Dimension::orderBy('id', 'desc')->get(), $colors, $materials, $brands, $shapes];
    }

    public function search(Request $request, $id)
    {
        $this->query = $request->input('brand');
        $collections = $request->input('collection');
        $dimensions = $request->input('dimension');
        $materials = $request->input('material');
        $shapes = $request->input('shape');
        $colors = $request->input('color');
        $subcategories = $request->input('subcategory');
        $selectedfilter = $request->input('selectedfilter');
        $nb_products = $request->input('nb_products');

        $query = Product::where('category_id', $id)->limit($nb_products);

        if ($this->query) {
            $brands_table = explode(",", $this->query);
            $query->whereIn('brand_id', $brands_table);
        }

        if ($collections) {
            $collections_table = explode(",", $collections);
            $query->whereIn('inspiration_id', $collections_table);
        }

        if ($dimensions) {
            $dimensions_table = explode(",", $dimensions);
            $test = DimensionProduct::whereIn('dimension_id', $dimensions_table)->get('product_id');
            $dimensions_products = [];
            foreach($test as $r){
                array_push($dimensions_products, $r->product_id);
            };
            $query->whereIn('id', $dimensions_products);
        }

        if ($materials) {
            $materials_table = explode(",", $materials);
            $test = MaterialProduct::whereIn('material_id', $materials_table)->get('product_id');
            $materials_products = [];
            foreach($test as $r){
                array_push($materials_products, $r->product_id);
            };
            $query->whereIn('id', $materials_products);
        }

        if ($shapes) {
            $shapes_table = explode(",", $shapes);
            $test = ProductShape::whereIn('shape_id', $shapes_table)->get('product_id');
            $shapes_products = [];
            foreach($test as $r){
                array_push($shapes_products, $r->product_id);
            };
            $query->whereIn('id', $shapes_products);
        }

        if ($colors) {
            $colors_table = explode(",", $colors);
            $test = ColorProduct::whereIn('color_id', $colors_table)->get('product_id');
            $colors_products = [];
            foreach($test as $r){
                array_push($colors_products, $r->product_id);
            };
            $query->whereIn('id', $colors_products);
        }

        if ($subcategories) {
            $subcategories_table = explode(",", $subcategories);
            $test = ProductSubcategory::whereIn('subcategory_id', $subcategories_table)->get('product_id');
            $subcategories_products = [];
            foreach($test as $r){
                array_push($subcategories_products, $r->product_id);
            };
            $query->whereIn('id', $subcategories_products);
        }

        if($selectedfilter == ''){
            $result = $query->orderBy('created_at', 'DESC')->get();
        } elseif ($selectedfilter == 2){
            $result = $query->orderBy('price', 'ASC')->get();
        } elseif ($selectedfilter == 3){
            $result = $query->orderBy('price', 'DESC')->get();
        } elseif ($selectedfilter == 1){
            $result = $query->orderBy('created_at', 'DESC')->get();
        } elseif ($selectedfilter == 4){
            $result = $query->orderBy('nb_in_list', 'DESC')->get();
        }

        return $result;
    }

    public function is_product_fav($auth_id)
    {
        return ProductUser::where('user_id', $auth_id)->get('product_id');
    }

    public function navSearch(Request $request)
    {
        $this->query = $request->input('query');
        $products = Product::whereHas('category', function (Builder $q) {
            $q->where('name', 'like', '%' . $this->query . '%');
        })->orWhere('name', 'like', '%' . $this->query . '%')->limit(3)->orderBy('created_at', 'DESC')->get();
        return $products;
    }

    public function jsondata()
    {
        return Product::without('brand')->without('img_products')->orderBy('created_at', 'desc')->limit(50)->get();
    }

    public function backoffice_search(Request $request)
    {
        $this->query = $request->input('query');
        $query2 = $request->input('query2');

        if($query2 != NULL){
            return Product::where('name', 'like', '%' . $this->query . '%')->where('category_id', $query2)->limit(35)->get();
        } else {
            return Product::where('name', 'like', '%' . $this->query . '%')->limit(35)->get();
        }
    }
}
