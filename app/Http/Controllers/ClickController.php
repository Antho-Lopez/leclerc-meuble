<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\StatCatalog;
use App\Models\StatDevice;
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
        $data_devices = StatDevice::whereBetween('created_at', [Carbon::create($request->input('from')), Carbon::create($request->input('to'))->addDay()])->get();
        $data_cata = StatCatalog::whereBetween('created_at', [Carbon::create($request->input('from')), Carbon::create($request->input('to'))->addDay()])->get();

        $come_from = $data_devices->groupBy(['come_from']);
        $nb_client = $data_devices->groupBy(['device_type']);
        $nb_click_cata = $data_cata->groupBy(['name']);

        $category = $data->where('url_name', 'products')->groupBy(['param_name'])->take($request->input('max'));
        $product = $data->where('url_name', 'oneproduct')->groupBy(['param_name']);

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

        return response()->json(['urls' => $urls, 'come_from' => $come_from, 'nb_client' => $nb_client, 'nb_click_cata' => $nb_click_cata, 'category' => $category, 'product' => $viewed_products]);

    }
}
