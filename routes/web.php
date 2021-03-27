<?php

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', 'BlogController@index');
// Route::get('/content-blog', function(){
//     return view('blog.content_blog');
// });

// Route::get('login', function(){
//     return View('auth.login');
// });

Route::get('/content_blog/{slug}', 'BlogController@content_blog')->name('blog.content');
Route::get('/list_blog', 'BlogController@list')->name('blog.list');
Route::get('/list_category{category}','BlogController@list_category')->name('blog.category');
Route::get('/search', 'BlogController@search')->name('blog.search');
Route::get('/about', 'BlogController@about')->name('blog.about');
Route::get('/contact', 'BlogController@contact')->name('blog.contact');


Route::get('/sapi', function () {
    return view('headerblog.sapi');
});
Route::get('/kambing', function () {
    return view('headerblog.kambing');
});
Route::get('/ayam', function () {
    return view('headerblog.ayam');
});

Route::group(['middleware' => ['CekRole:admin']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/category', 'CategoryController');
    Route::resource('/tag', 'TagController');
    Route::get('/post/show_delete','PostController@show_delete')->name('post.show_delete');
    Route::get('/post/restore/{id}', 'PostController@restore')->name('post.restore');
    Route::delete('/post/deleted/{id}','PostController@deleted')->name('post.deleted');
    Route::resource('/post', 'PostController');
    Route::get('/farmadmin', 'PostController@indexadmin');
    Route::resource('/user','UserController');
    Route::get('/pegawai', 'PdfController@index');
    Route::get('/pegawai/cetak_pdf', 'PdfController@cetak_pdf');
    Route::delete('/deletee/{id}', 'PostController@deleteadmin')->name('deletee');
});

Route::group(['middleware' => ['CekRole:user']], function(){
    Route::get('/homeuser', 'HomeController@indexxx')->name('homee');
    Route::get('/postuser', 'PostController@indexuser');
    Route::get('/postcreate','PostController@postcreate')->name('postcreate');
    Route::post('/createternaku','PostController@createternaku')->name('createternaku');
    route::delete('/postdestroy{id}','PostController@postdestroy')->name('postdestroy');
    Route::get('/editpost{id}', 'PostController@editpostform')->name('editpost');
    Route::put('/updatepost/{id}','PostController@editpost')->name('updatepost');

    Route::get('/farmindex', 'PostController@indexfarm');
    Route::get('/form', 'PostController@formcreate')->name('form');
    Route::post('/createfarm', 'PostController@createfarm')->name('createfarm');
    Route::delete('/delete/{id}','PostController@delete')->name('delete');

});



// Route::get('/index', function () {
//     return view('index');
// });
// Route::get('/landing', function () {
//     return view('landing');
// });
