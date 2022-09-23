<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\StatCatalog;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function index()
    {
        $catalogs = Catalog::orderBy('created_at', 'desc')->get();
        return view('catalogs.index', compact('catalogs'));

    }

    public function edit($id)
    {
        $catalog = Catalog::find($id);

        return view('catalogs.edit', compact('catalog'));
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'name' => 'nullable',
            'img_name' => 'nullable',
            'link' => 'nullable',
            'is_on_home' => '',
        ]);

        if(isset($data['is_on_home'])){
            $data['is_on_home'] = 1;
        } else {
            $data['is_on_home'] = 0;
        }

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

        Catalog::where('id', $id)->update($data);
        return redirect()->route('catalog.index')->with('success_message', 'Le visuel d\'accueil a bien été modifiée');
    }

    public function forstat($id)
    {
        $catalog = Catalog::find($id);

        StatCatalog::create([
            'name' => $catalog->name,
            'link' => $catalog->link
        ]);

        return redirect($catalog->link);
    }

}
