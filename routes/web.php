<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'MessageController@showList');

Route::get('users', function () {
    if(!Auth::user()->is_admin){
        return redirect('/');
    }
    $users = DB::table('users')->where('id','!=',Auth::user()->id)->orderBy('id')->get();
    return view('users', ['users'=>$users]);
})->middleware('auth');

Route::post('save/{id}', function(Request $request, $id) {
    if (Auth::user()->id != $id) {
        $isAdmin = $request->exists('is_admin');
        DB::table('users')->where('id', $id)->update(['is_admin' => $isAdmin]);
    }
    return redirect('/users');
});

Route::post('/add','MessageController@add');

Route::delete('/message/{message}','MessageController@delete');

Auth::routes();

Route::get('/home','HomeController@index')->name('home');
