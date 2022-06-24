<?php

namespace App\Http\Controllers;

use App\Models\Dimension;
use App\Models\DimensionProduct;
use Illuminate\Http\Request;

class DimensionController extends Controller
{
    public function index()
    {
        $dimensions = Dimension::orderBy('created_at', 'desc')->paginate(10);
        return view('dimensions.index', compact('dimensions'));
    }

    public function create()
    {
        return view('dimensions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'size' => 'required',
        ]);

        Dimension::create($data);
        return redirect()->route('dimension.index')->with('success_message', 'La dimension a bien été créée');
    }

    public function edit($id)
    {
        $dimension = Dimension::find($id);
        return view('dimensions.edit', compact('dimension'));
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'size' => 'required',
        ]);
        Dimension::where('id', $id)->update($data);

        return redirect()->route('dimension.index')->with('success_message', 'La dimension a bien été modifiéé');
    }

    public function delete($id)
    {
        Dimension::where('id', $id)->delete();
        DimensionProduct::where('dimension_id', $id)->delete();
        return redirect()->route('dimension.index')->with('success_message', 'La dimension a bien été supprimée');

    }
}
