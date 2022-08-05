<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/php', function () {
    return view('php');
});

Route::get('/hello', function () {
    //200 tu nombor response mcm 404. 200 by default
    return response('<h1>hello world</h1>', 200)
        //text/plain tu tukar html tag jdi plain. text/html by default
        ->header('Content-Type', 'text/plain')
        //masukkan pape dalam header
        ->header('nama', 'arif');
});

Route::get('/posts/{id}', function ($id) {
    //dd and ddd is used for debugging. dd is die and dump. ddd is
    //dump die and debugging
    //dd($id);
    ddd($id);
    return response('Post ' . $id);
})->where('id', '[0-9]+');

Route::get('/search', function (Request $request) {
    // dd($request->name .' '.$request->city); <-for debug
    return $request->name . ' ' . $request->city;
});


//All Listing using controller
Route::get('/', [ListingController::class, 'index']);

//single listing

// Route::get('/listings/{id}', function($id){
//     $listing = Listing::find($id);

//     if($listing){
//         return view('listing',[
//             'listing' => $listing
//         ]);
//     }else{
//         abort('404');
//     }
// });

//show listing create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//update listing
//guna put
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//delete listing
//guna delete
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//manage listings
Route::get('listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//single listing using controller
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//show user create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//create new user
Route::post('/users', [UserController::class, 'store']);

//logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
