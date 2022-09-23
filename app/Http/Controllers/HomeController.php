<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\ImgGlobal;
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
        $contact = OurInformation::find(1);
        $socials = SocialMedia::get();
        $categories = Category::get();
        $catalog = Catalog::where('is_on_home', 1)->find(2);
        $services = Catalog::where('is_on_home', 1)->find(1);
        $finance = Catalog::where('is_on_home', 1)->find(3);

        return view('home', compact('accueil', 'logo', 'contact', 'socials', 'categories', 'catalog', 'services', 'finance'));
    }

    public function newsletter(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create($data);
        return redirect()->route('home')->with('success_message', "L'inscription s'est déroulée avec succès");
    }

    public function newsletter_index()
    {
        $newsletters = Newsletter::get();
        return view('newsletters.index', compact('newsletters'));
    }

    public function redirectHome(){
        return redirect()->route('home');
    }

    public function conditions()
    {
        return view('conditions');
    }

    public function confidential()
    {
        return view('confidential');
    }
}

