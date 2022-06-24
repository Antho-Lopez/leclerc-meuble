<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show($id)
    {  
        $contact = Contact::find($id);
        return view('contacts.show', compact('contact'));   
    }

    public function edit($id)
    {
        $contact = Contact::where('id', $id)->find($id);
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
        Contact::where('id', $id)->update($data);

        return redirect()->route('contact.show', 1)->with('success_message', "les informations de contact ont bien été modifiées");
    }

}
