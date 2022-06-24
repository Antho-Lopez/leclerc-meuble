<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    // Route::middleware('api')->get('/brands', 'BrandController@jsondata');
    // Route::middleware('api')->get('/colors', 'ColorController@jsondata');
    // Route::middleware('api')->get('/materials', 'MaterialController@jsondata');
    // Route::middleware('api')->get('/dimensions', 'DimensionController@jsondata');
    Route::middleware('api')->get('/categories', 'CategoryController@jsondata');
    Route::middleware('api')->get('/products', 'ProductController@jsondata');
    Route::middleware('api')->get('/productSearch', 'ProductController@backoffice_search');
    // Route::middleware('api')->get('/collections', 'InspirationController@jsondata');
    // Route::middleware('api')->get('/category/{id}/products', 'ProductController@jsondata');
    // Route::middleware('api')->get('/collection/{id}/products', 'ProductController@collectionproducts');

    Route::middleware('api')->get('/filters/{category_id}', 'ProductController@filters');
    Route::middleware('api')->get('/subcategories/{id}', 'SubcategoryController@jsondata');
    Route::middleware('api')->get('/fav_products/{auth_id}', 'ProductController@is_product_fav');
    Route::middleware('api')->get('/category/{id}/productsSearch', 'ProductController@search');
    Route::middleware('api')->get('/collection/{id}/productsCollectionSearch', 'InspirationController@collectionsearch');
    Route::middleware('api')->get('/product/{id}', 'ProductController@oneProductDatas');

    Route::middleware('api')->get('/navSearch', 'ProductController@navSearch');
    
    Route::middleware('api')->get('/stat', 'ClickController@json');


