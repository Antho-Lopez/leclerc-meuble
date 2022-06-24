<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\ImgGlobal;
use App\Models\Inspiration;
use App\Models\Product;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class InspirationController extends Controller
{
    public function index()
    {
        $inspirations = Inspiration::where('id', '!=', 1)->orderBy('created_at', 'desc')->paginate(10);

        return view('inspirations.index', compact('inspirations'));
    }

    public function show($id)
    {
        $inspiration = Inspiration::with('products')->find($id);
        return view('inspirations.show', compact('inspiration'));
    }

    public function create()
    {
        return view('inspirations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'is_favorite' => 'nullable',
            'img_name' => 'required',

        ]);

        $filename = time() . '.' . $request->img_name->extension();

        $data['name'] = str_replace(' ', '-', $data['name']);
        $data['name'] = strtolower($data['name']);

        $data['img_name'] = $request->file('img_name')->storeAs(
            $data['name'],
            $filename,
            'public'
        );

        $miniature = Image::make($request->file('img_name'));
        $miniature->resize(null, 590, function($constraint) {
            $constraint->aspectRatio();
        });
        $img_path = public_path('storage/' . $data['name'] . '/' .'miniature'. '-' . $filename);
        $miniature->save($img_path, 80);

        $for_nav = Image::make($request->file('img_name'));
        $for_nav->resize(null, 190, function($constraint) {
            $constraint->aspectRatio();
        });
        $img_path = public_path('storage/' . $data['name'] . '/' .'for_nav'. '-' . $filename);
        $for_nav->save($img_path, 80);

        $count_favorite = Inspiration::where('is_favorite', '=', 1)->count();

        if(isset($data['is_favorite']) && $count_favorite >= 3){

            Inspiration::create($data);
            $favorite_inspirations = Inspiration::where('is_favorite', '=', 1)->get();
            return view('inspirations.manage_favorite', compact('favorite_inspirations'));
        }

        Inspiration::create($data);
        return redirect()->route('inspiration.index')->with('success_message', "la collection a bien été ajoutée");
    }

    public function edit($id)
    {
        $inspiration = Inspiration::where('id', $id)->find($id);
        return view('inspirations.edit', compact('inspiration'));
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'is_favorite' => 'nullable',
            'img_name' => 'nullable',

        ]);

        $data['name'] = str_replace(' ', '-', $data['name']);
        $data['name'] = strtolower($data['name']);

        if(isset($data['img_name'])){
            $filename = time() . '.' . $request->img_name->extension();
            $data['img_name'] = $request->file('img_name')->storeAs(
                $data['name'],
                $filename,
                'public'
            );
            $miniature = Image::make($request->file('img_name'));
            $miniature->resize(null, 590, function($constraint) {
                $constraint->aspectRatio();
            });
            $img_path = public_path('storage/' . $data['name'] . '/' .'miniature'. '-' . $filename);
            $miniature->save($img_path, 80);

            $for_nav = Image::make($request->file('img_name'));
            $for_nav->resize(null, 190, function($constraint) {
                $constraint->aspectRatio();
            });
            $img_path = public_path('storage/' . $data['name'] . '/' .'for_nav'. '-' . $filename);
            $for_nav->save($img_path, 80);
        }

        $count_favorite = Inspiration::where('is_favorite', '=', 1)->count();
        $is_already_fav = Inspiration::where('id', $id)->find($id);

        if($is_already_fav->is_favorite != 1 && isset($data['is_favorite']) && $count_favorite >= 3){

            Inspiration::where('id', $id)->update($data, ['is_favorite' => 1]);
            $favorite_inspirations = Inspiration::where('is_favorite', '=', 1)->get();
            return view('inspirations.manage_favorite', compact('favorite_inspirations'));

        } elseif($is_already_fav->is_favorite == 1 && !isset($data['is_favorite'])){

            Inspiration::where('id', $id)->update(['is_favorite' => 0], $data);
        }

        Inspiration::where('id', $id)->update($data);

        return redirect()->route('inspiration.index')->with('success_message', "la collection a bien été modifiée");
    }

    public function delete($id)
    {
        Inspiration::where('id', $id)->delete();
        return redirect()->route('inspiration.index')->with('success_message', 'La collection a bien été supprimée');

    }

    public function manage_favorite_store(Request $request)
    {
        $data = $request->validate([
            'id' => 'nullable',
        ]);
        Inspiration::where('id', $data['id'])->update(['is_favorite' => 0]);
        return redirect()->route('inspiration.index')->with('success_message', 'La collection a bien été Ajoutée/Modifiée');

    }

    public function indexFront()
    {
        $logo = ImgGlobal::find(1);
        $inspirations = Inspiration::where('id', '!=', 1)->orderBy('created_at', 'desc')->paginate(6);
        $contact = Contact::find(1);
        $socials = SocialMedia::get();
        $categories = Category::get();

        return view('collections', compact('inspirations', 'logo', 'contact', 'socials', 'categories'));
    }

    // public function jsondata()
    // {
    //     return Inspiration::orderBy('id', 'desc')->skip(1)->get();
    // }

    public function displayCollectionProducts($id)
    {
        $products = Product::where('inspiration_id', $id)->with('img_products')->orderBy('created_at', 'DESC')->paginate(15);
        $logo = ImgGlobal::find(1);
        $contact = Contact::find(1);
        $socials = SocialMedia::get();
        $categories = Category::get();
        $inspirations = Inspiration::where('id', '!=' , 1)->orderBy('created_at', 'desc')->limit(6)->get();
        $current_collection = Inspiration::where('id', $id)->find($id);

        return view('collectionproducts', compact('current_collection', 'products', 'logo', 'contact', 'socials', 'inspirations', 'categories'));
    }

    public function collectionsearch(Request $request, $id)
    {
        $selectedfilter = $request->input('selectedfilter');
        $nb_products = $request->input('nb_products');

        $query = Product::where('inspiration_id', $id)->orderBy('created_at', 'DESC')->limit($nb_products);
        $nb_results = Product::where('inspiration_id', $id)->count();

        if($selectedfilter == ''){
            $result = $query->get();
        } elseif ($selectedfilter == 2){
            $result = $query->orderBy('price', 'ASC')->get();
        } elseif ($selectedfilter == 3){
            $result = $query->orderBy('price', 'DESC')->get();
        } elseif ($selectedfilter == 1){
            $result = $query->orderBy('created_at', 'DESC')->get();
        }

        return [$result, $nb_results];
    }
}
