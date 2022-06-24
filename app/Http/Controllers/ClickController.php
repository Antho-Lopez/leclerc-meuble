<?php

namespace App\Http\Controllers;

use App\Models\Click;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClickController extends Controller
{

    public function index()
    {
        return view('statistics.index');
    }

    public function json(Request $request){

        $data = Click::whereBetween('created_at', [Carbon::create($request->input('from')), Carbon::create($request->input('to'))->addDay()])->get();

        $category = $data->where('url_name', 'products')->groupBy(['param_name'])->take($request->input('max'));
        $collection = $data->where('url_name', 'collectionproducts')->groupBy(['param_name'])->take($request->input('max'));
        $product = $data->where('url_name', 'oneproduct')->groupBy(['param_name']);
        // dd($request->input('less_popular'));
        if($request->input('popularity') == 1){
            $viewed_products = $product->sortBy(function ($test, $key) {
                return count($test);
            })->take($request->input('max'));
        } else {
            $viewed_products = $product->sortByDesc(function ($test, $key) {
                return count($test);
            })->take($request->input('max'));
        }


        $urls = Click::select('url_name')->distinct()->get();
        $urls = $urls->map(function ($item, $key) {
            return $item->url_name;
        });

        return response()->json(['urls' => $urls, 'category' => $category, 'collection' => $collection, 'product' => $viewed_products]);

    }
}
