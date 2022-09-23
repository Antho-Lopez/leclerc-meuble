<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Click;
use App\Models\Product;
use Closure;
use Illuminate\Http\Request;

class ClickOnPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $url_name = \Route::currentRouteName();
        $url_param = $request->route('id');
        if($url_name == 'products'){

            $category_name = Category::find($url_param);
            Click::create([
                'url_name' => $url_name,
                'url_param' => $url_param,
                'param_name' => $category_name->name
            ]);
        }

        if($url_name == 'oneproduct'){
            $product_name = Product::find($url_param);
            Click::create([
                'url_name' => $url_name,
                'url_param' => $url_param,
                'param_name' => $product_name->name
            ]);
        }

        return $next($request);
    }
}
