<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ImgGlobal;
use App\Models\Inspiration;
use App\Models\Newsletter;
use App\Models\OurInformation;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $accueil = ImgGlobal::find(2);
        $logo = ImgGlobal::find(1);
        $fav_collections = Inspiration::where('is_favorite', 1)->get();
        $contact = OurInformation::find(1);
        $socials = SocialMedia::get();
        $categories = Category::get();
        $inspirations = Inspiration::where('id', '!=' , 1)->orderBy('created_at', 'desc')->limit(6)->get();

        return view('home', compact('accueil', 'logo', 'fav_collections', 'contact', 'socials', 'categories', 'inspirations'));
    }

    public function newsletter(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create($data);
        return redirect()->route('home')->with('success_message', "L'inscription s'est déroulée avec succès");
    }

}

