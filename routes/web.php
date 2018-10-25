<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Message;
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

Route::post('/add', function(Request $request){
    $message = new Message();
    Validator::make($request->all(), [
        'text' => 'required|unique:messages'
    ], $message->messages())->validate();
    $message->user_id = Auth::user()->id;
    $message->text = htmlentities($request->text);
    $message->save();
    return redirect('/');
});

Route::delete('/message/{message}', function (Message $message) {
    if($message->user_id == Auth::user()->id) $message->delete();
    return redirect('/');
});

Auth::routes();

Route::get('/home','HomeController@index')->name('home');
