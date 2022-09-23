<?php

use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@redirectHome');
Route::get('/conditions', 'HomeController@conditions')->name('conditions');
Route::get('/confidential', 'HomeController@confidential')->name('confidential');

Route::middleware(['click_on_page', 'stat_device_creation'])->group(function() {
    Route::get('/categories/{id}/{social_media?}', 'ProductController@displayFront')->name('products');
    Route::get('oneproduct/{id}/{social_media?}', 'ProductController@displayFrontOne')->name('oneproduct');
});

Route::post('/newsletter/store', 'HomeController@newsletter')->name('newsletter');
Route::middleware('stat_device_creation')->get('/home/{social_media?}',  'HomeController@index')->name('home');

Route::get('/favorites/{id}', 'ProductController@fav')->name('myfav');

Route::name('product.')->prefix('product')->group(function() {
    Route::post('/{id}/add_fav/{auth_id}', 'ProductController@add_fav')->name('add_fav');
    Route::post('/{id}/remove_fav/{auth_id}', 'ProductController@remove_fav')->name('remove_fav');
});


Route::middleware(['auth', 'can:is_validate'])->group(function() {
    Route::get('/backoffice-home', 'BackofficeHomeController@index')
    ->name('backoffice-home');

      // CATEGORIES
      Route::name('category.')->prefix('category')->group(function() {
        Route::get('/index', 'CategoryController@index')
        ->name('index');
        Route::get('/create', 'CategoryController@create')
        ->name('create');
        Route::post('/store', 'CategoryController@store')
        ->name('store');
        Route::get('/{id}/edit', 'CategoryController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'CategoryController@update')
        ->name('update');
        Route::get('/{id}/delete', 'CategoryController@delete')
        ->name('delete');
    });

     // MARQUES
    Route::name('brand.')->prefix('brand')->group(function() {
      Route::get('/index', 'BrandController@index')
      ->name('index');
      Route::get('/create', 'BrandController@create')
      ->name('create');
      Route::post('/store', 'BrandController@store')
      ->name('store');
      Route::get('/{id}/edit', 'BrandController@edit')
      ->name('edit');
      Route::post('/{id}/update', 'BrandController@update')
      ->name('update');
      Route::get('/{id}/delete', 'BrandController@delete')
      ->name('delete');
    });

    // MATERIAUX
    Route::name('material.')->prefix('material')->group(function() {
        Route::get('/index', 'MaterialController@index')
        ->name('index');
        Route::get('/create', 'MaterialController@create')
        ->name('create');
        Route::post('/store', 'MaterialController@store')
        ->name('store');
        Route::get('/{id}/edit', 'MaterialController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'MaterialController@update')
        ->name('update');
        Route::get('/{id}/delete', 'MaterialController@delete')
        ->name('delete');
    });

    // TECHNOLOGIES
    Route::name('technology.')->prefix('technology')->group(function() {
        Route::get('/index', 'TechnologyController@index')
        ->name('index');
        Route::get('/create', 'TechnologyController@create')
        ->name('create');
        Route::post('/store', 'TechnologyController@store')
        ->name('store');
        Route::get('/{id}/edit', 'TechnologyController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'TechnologyController@update')
        ->name('update');
        Route::get('/{id}/delete', 'TechnologyController@delete')
        ->name('delete');
    });


    // TYPE
    Route::name('type.')->prefix('type')->group(function() {
        Route::get('/index', 'TypeController@index')
        ->name('index');
        Route::get('/create', 'TypeController@create')
        ->name('create');
        Route::post('/store', 'TypeController@store')
        ->name('store');
        Route::get('/{id}/edit', 'TypeController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'TypeController@update')
        ->name('update');
        Route::get('/{id}/delete', 'TypeController@delete')
        ->name('delete');
    });


     // FORME
     Route::name('shape.')->prefix('shape')->group(function() {
        Route::get('/index', 'ShapeController@index')
        ->name('index');
        Route::get('/create', 'ShapeController@create')
        ->name('create');
        Route::post('/store', 'ShapeController@store')
        ->name('store');
        Route::get('/{id}/edit', 'ShapeController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'ShapeController@update')
        ->name('update');
        Route::get('/{id}/delete', 'ShapeController@delete')
        ->name('delete');
    });

     // DIMENSIONS
    Route::name('dimension.')->prefix('dimension')->group(function() {
      Route::get('/index', 'DimensionController@index')
      ->name('index');
      Route::get('/create', 'DimensionController@create')
      ->name('create');
      Route::post('/store', 'DimensionController@store')
      ->name('store');
      Route::get('/{id}/edit', 'DimensionController@edit')
      ->name('edit');
      Route::post('/{id}/update', 'DimensionController@update')
      ->name('update');
      Route::get('/{id}/delete', 'DimensionController@delete')
      ->name('delete');
    });

      // COULEURS
    Route::name('color.')->prefix('color')->group(function() {
        Route::get('/index', 'ColorController@index')
        ->name('index');
        Route::get('/create', 'ColorController@create')
        ->name('create');
        Route::post('/store', 'ColorController@store')
        ->name('store');
        Route::get('/{id}/edit', 'ColorController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'ColorController@update')
        ->name('update');
        Route::get('/{id}/delete', 'ColorController@delete')
        ->name('delete');
    });

      // PRODUITS
    Route::name('product.')->prefix('product')->group(function() {
        Route::get('/index', 'ProductController@index')
        ->name('index');
        Route::get('/{id}/show', 'ProductController@show')
        ->name('show');
        Route::get('/create', 'ProductController@create')
        ->name('create');
        Route::post('/store', 'ProductController@store')
        ->name('store');
        Route::get('/{id}/edit', 'ProductController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'ProductController@update')
        ->name('update');
        Route::post('/{id}/manage_first/{img_id}', 'ProductController@manage_first')
        ->name('manage_first');
        Route::get('/{id}/delete', 'ProductController@delete')
        ->name('delete');
        Route::get('/{product_id}/file/{id}', 'ProductController@downloadFile')
        ->name('file');
        Route::get('/{product_id}/image/{id}', 'ProductController@displayImage')
        ->name('image.displayImage');
    });

     // INFORMATIONS DE CONTACT
    Route::name('contact.')->prefix('contact')->group(function() {
      Route::get('/{id}/show', 'OurInformationController@show')
      ->name('show');
      Route::get('/create', 'OurInformationController@create')
      ->name('create');
      Route::post('/store', 'OurInformationController@store')
      ->name('store');
      Route::get('/{id}/edit', 'OurInformationController@edit')
      ->name('edit');
      Route::post('/{id}/update', 'OurInformationController@update')
      ->name('update');
    });

      // RESEAUX SOCIAUX
    Route::name('social_media.')->prefix('social_media')->group(function() {
        Route::get('/index', 'SocialMediaController@index')
        ->name('index');
        Route::get('/create', 'SocialMediaController@create')
        ->name('create');
        Route::post('/store', 'SocialMediaController@store')
        ->name('store');
        Route::get('/{id}/edit', 'SocialMediaController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'SocialMediaController@update')
        ->name('update');
        Route::get('/{id}/delete', 'SocialMediaController@delete')
        ->name('delete');
    });

    // CATALOGUES
    Route::name('catalog.')->prefix('catalog')->group(function() {
        Route::get('/index', 'CatalogController@index')
        ->name('index');
        Route::get('/{id}/edit', 'CatalogController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'CatalogController@update')
        ->name('update');
        Route::get('/{id}/forstat', 'CatalogController@forstat')
        ->name('forstat');
    });

    // IMAGES GLOBALES
    Route::name('img_global.')->prefix('img_global')->group(function() {
        Route::get('/index', 'ImgGlobalController@index')
        ->name('index');
        Route::get('/{id}/edit', 'ImgGlobalController@edit')
        ->name('edit');
        Route::post('/{id}/update', 'ImgGlobalController@update')
        ->name('update');
    });

     // STATISTIQUES
     Route::name('statistic.')->prefix('statistic')->group(function() {
        Route::get('/index', 'ClickController@index')
        ->name('index');
    });
      // STATISTIQUES
      Route::name('newsletter.')->prefix('newsletter')->group(function() {
        Route::get('/index', 'HomeController@newsletter_index')
        ->name('index');
    });
});
  // RESEAUX SOCIAUX
  Route::name('user.')->prefix('user')->group(function() {
    Route::get('/{id}/edit', 'UserController@edit')
    ->name('edit');
    Route::post('/{id}/update', 'UserController@update')
    ->name('update');
});

Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('registeradmin');
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('loginadmin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/logout/admin', 'Auth\LoginController@logout')->name('logout');
Route::get('/verify', 'UserController@verify')->name('verify');

Auth::routes();

Route::get('/email/verify', function () {
  return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

  $request->fulfill();
  return redirect('/login');

})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {

  $request->user()->sendEmailVerificationNotification();
  return back()->with('message', 'Verification link sent!');

})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
