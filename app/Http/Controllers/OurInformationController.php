<?php

namespace App\Http\Controllers;

use App\Models\OurInformation;
use Illuminate\Http\Request;

class OurInformationController extends Controller
{
    public function show($id)
    {
        $contact = OurInformation::find($id);
        return view('contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        $contact = OurInformation::where('id', $id)->find($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'cp' => 'required|digits:5',
            'city' => 'required',

        ]);

        $data['phone'] = str_replace(' ', '', $data['phone']);
        OurInformation::where('id', $id)->update($data);

        return redirect()->route('contact.show', 1)->with('success_message', "les informations de contact ont bien été modifiées");
    }
}
