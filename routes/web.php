<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Autoverify;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
     return view('login');
});

Route::get('/register',function (){
    return view('regester');
});

Route::get('/pusher',function (){

    return view('puser');
});

ROute::get('/send_puser',[Autoverify::class,'send_puser']);

Route::get('/pusher2',function (){

    return view('puser2');
});

// Route::get('/deshbord',function (){
//     return view('display');
// });

Route::get('/deshbord',[Autoverify::class,'view_deshbord']);
Route::Post("/user_register",[Autoverify::class,'register']);
Route::Post("/search_value",[Autoverify::class,'search_value']);
Route::Post('/message_id',[Autoverify::class,'messagess']);
Route::Post('/login',[Autoverify::class,'login']);
Route::Post('/send_message',[Autoverify::class,'send_message']);

