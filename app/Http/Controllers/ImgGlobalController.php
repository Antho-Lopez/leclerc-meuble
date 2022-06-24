<?php

namespace App\Http\Controllers;

use App\Models\ImgGlobal;
use Illuminate\Http\Request;

class ImgGlobalController extends Controller
{
    /**
     * This function is used to display all the images in the database
     * @return The view 'img_globals.index' is being returned.
     */
    public function index()
    {
        $img_globals = ImgGlobal::orderBy('created_at', 'desc')->get();
        return view('img_globals.index', compact('img_globals'));
    }

   /**
    * This function is used to edit the image global
    * @param id The ID of the image you want to edit.
    * @return The view for the edit page.
    */
    public function edit($id)
    {
        $img_global = ImgGlobal::where('id', $id)->find($id);
        return view('img_globals.edit', compact('img_global'));
    }

    /**
     * Update an image
     * 
     * @param Request request The request object.
     * @param id The ID of the row to update.
     * @return The view of the index page.
     */
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => 'nullable',
            'img_name' => 'required',

        ]);
        
        $img = ImgGlobal::where('id', $id)->get();

        if(isset($data['img_name'])){
            $filename = time() . '.' . $request->img_name->extension();
            $data['img_name'] = $request->file('img_name')->storeAs(
                $img[0]->name,
                $filename,
                'public'
            );
        }

        ImgGlobal::where('id', $id)->update([
            'name' => $img[0]->name,
            'img_name' => $data['img_name'],
        ]);

        return redirect()->route('img_global.index')->with('success_message', "l'image a bien été modifiée");
    }


}
