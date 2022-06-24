<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $medias = SocialMedia::orderBy('created_at', 'desc')->get();
        return view('social_medias.index', compact('medias'));
    }

    public function create()
    {   
        return view('social_medias.create');
    }

    public function store(Request $request)
    {     
        $data = $request->validate([
            'name' => 'required',
            'img_name' => 'required',
            'link' => 'required',
        ]);

        SocialMedia::create($data);
        return redirect()->route('social_media.index')->with('success_message', 'Le lien vers ce réseau social a bien été ajouté');
    }

    public function edit($id)
    {
        $media = SocialMedia::find($id);
        return view('social_medias.edit', compact('media'));
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'name' => 'required',
            'img_name' => 'required',
            'link' => 'required',
        ]);

        SocialMedia::where('id', $id)->update($data);

        return redirect()->route('social_media.index')->with('success_message', 'Les informations de ce réseau social ont bien été modifiés');
    }   

    public function delete($id)
    {
        SocialMedia::where('id', $id)->delete();
        return redirect()->route('social_media.index')->with('success_message', 'Le lien vers ce réseau social a bien été supprimé');

    }
}
