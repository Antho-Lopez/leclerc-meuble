<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ImgGlobal;
use App\Models\OurInformation;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VerifyUser;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function verify(Request $request){
        $token = $request->token;
        $verifyUser = VerifyUser::where('token')->first();
        if(!isNull($verifyUser)){
            $user = $verifyUser->user;

            if(!$user->is_email_verified){
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();

                return redirect()->route('login')->with('success_message', 'Email vérifié avec succès, vous pouvez maintenant vous connecter');
            } else {
                return redirect()->route('login')->with('success_message', 'Email déja vérifié, vous pouvez vous connecter');
            }
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        $logo = ImgGlobal::find(1);
        $contact = OurInformation::find(1);
        $socials = SocialMedia::get();
        $categories = Category::get();

        return view('auth.edit', compact('user', 'logo', 'contact', 'socials', 'categories'));
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'city' => ['nullable'],
            'cp' => ['nullable'],
        ]);
        User::where('id', $id)->update($data);

        return redirect()->route('home')->with('success_message', 'Vos informations ont bien été modifiées');
    }
}
