<?php
//use App\Http\Controllers\blog\postcontroller;

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

Route::get('/', 'welcomecontroller@index')->name('welcome');
Route::get('blog/posts/{post}','postblogcontroller@show')->name('blog.show');
Route::get('blog/catagories/{catagory}','postblogcontroller@catagory')->name('blog.catagory');
Route::get('blog/tags/{tag}','postblogcontroller@tag')->name('blog.tag');

Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('catagories','catagories');
    Route::resource('tags','tags');
    Route::resource('posts','postscontroller');
    Route::get('trashed-posts', 'postscontroller@trashed')->name('trashed-posts.index');
    Route::put('posts.restore/{post}','postscontroller@restore')->name('posts.restore');

});

Route::middleware(['auth','admin'])->group(function(){
    Route::get('users/profile','usercontroller@edit')->name('users.edit');
    Route::get('users','usercontroller@index')->name('users.index');
    Route::put('users/profile','usercontroller@update')->name('users.update');
    Route::post('users/{user}/makeadmin','usercontroller@makeadmin')->name('makeadmin');

});
//enatu pro batu musli ye harar liji bersu orto....dorem metoch pro nachew ...ashu 

