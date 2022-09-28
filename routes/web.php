<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DestinationCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TourCategoryController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\PageController;

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

Route::get('/d', function () {
    return view('welcome');
});
Auth::routes();



Route::get('/admin/pages', [PageController::class, 'all']);
Route::get('/admin/pages/add', [PageController::class, 'add']);
Route::post('/admin/pages', [PageController::class, 'store']);
Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit']);
Route::put('/admin/pages/{page}', [PageController::class, 'update']);
Route::delete('/admin/pages/{page}', [PageController::class, 'remove']);
//----------------------------------------------------------------------
Route::get('/', [PageController::class, 'home']);
Route::get('/{page}', [PageController::class, 'show']);
Route::get('/tour/gallery', [PageController::class, 'gallery']);
Route::post('/safari/booking', [PageController::class, 'booking']);
Route::any('/safari/contacts', [PageController::class, 'contacts']);

//----------------------------------------------------------------------

Route::get('/admin/places', [DestinationController::class, 'all']);
Route::get('/admin/places/add',[DestinationController::class, 'add']);
Route::post('/admin/places', [DestinationController::class, 'store']);
Route::get('/admin/places/{place}/edit', [DestinationController::class, 'edit']);
Route::put('/admin/places/{place}', [DestinationController::class, 'update']);
Route::delete('/admin/places/{place}', [DestinationController::class, 'remove']);
//----------------------------------------------------------------------
//Route::get('/tanzania/destinations', [DestinationController::class, 'index');
Route::get('/destinations/{d}', [DestinationController::class, 'show']);

//----------------------------------------------------------------------

Route::get('/tanzania/places-to-go', [DestinationCategoryController::class, 'index']);
Route::get('/places-to-go/{area}', [DestinationCategoryController::class, 'show']);
//----------------------------------------------------------------------
Route::get('/admin/destination-categories/', [DestinationCategoryController::class, 'all']);
Route::get('/admin/destination-categories/add', [DestinationCategoryController::class, 'add']);
Route::post('/admin/destination-categories/', [DestinationCategoryController::class, 'store']);
Route::get('/admin/destination-categories/{category}/edit', [DestinationCategoryController::class, 'edit']);
Route::put('/admin/destination-categories/{category}', [DestinationCategoryController::class, 'update']);
Route::delete('/admin/destination-categories/{category}', [DestinationCategoryController::class, 'remove']);

//----------------------------------------------------------------------

Route::get('/admin/tour-categories/', [TourCategoryController::class, 'all']);
Route::get('/admin/tour-categories/add', [TourCategoryController::class, 'add']);
Route::post('/admin/tour-categories/', [TourCategoryController::class, 'store']);
Route::get('/admin/tour-categories/{category}/edit', [TourCategoryController::class, 'edit']);
Route::put('/admin/tour-categories/{category}/', [TourCategoryController::class, 'update']);
Route::delete('/admin/tour-categories/{category}/', [TourCategoryController::class, 'remove']);
//----------------------------------------------------------------------
Route::get('/tanzania/safaris/', [TourCategoryController::class, 'index']);
Route::get('/safaris/{s}/', [TourCategoryController::class, 'show']);

//me
Route::resource('tours', TourController::class);
//--

Route::get('/admin/tours', [TourController::class, 'all']);
Route::get('/admin/tours/add', [TourController::class, 'add']);
Route::post('/admin/tours/', [TourController::class, 'store']);
Route::get('/admin/tours/{tour}/edit', [TourController::class, 'edit']);
Route::put('/admin/tours/{tour}', [TourController::class, 'update']);
Route::delete('/admin/tours/{tour}', [TourController::class, 'remove']);
//---------------------------------------------------------------------
//Route::get('/tanzania/safaris', [TourController::class, 'index');
Route::get('/tours/{t}', [TourController::class, 'show']);

//----------------------------------------------------------------------------------------------------------------------

Route::get('/admin/post-categories', [PostCategoryController::class, 'all']);
Route::get('/admin/post-categories/add', [PostCategoryController::class, 'add']);
Route::post('/admin/post-categories', [PostCategoryController::class, 'store']);
Route::get('/admin/post-categories/{category}/edit', [PostCategoryController::class, 'edit']);
Route::put('/admin/post-categories/{category}', [PostCategoryController::class, 'update']);
Route::delete('/admin/post-categories/{category}', [PostCategoryController::class, 'remove']);
//---------------------------------------------------------------------
Route::get('/tourism/blog', [PostCategoryController::class, 'index']);
Route::get('/tourism/blog/{category}', [PostCategoryController::class, 'show']);

//----------------------------------------------------------------------------------------------------------------------

Route::get('/admin/posts', [PostController::class, 'all']);
Route::get('/admin/posts/add', [PostController::class, 'add']);
Route::post('/admin/posts/', [PostController::class, 'store']);
Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit']);
Route::put('/admin/posts/{post}', [PostController::class, 'update']);
Route::delete('/admin/posts/{post}', [PostController::class, 'remove']);
//---------------------------------------------------------------------
Route::get('/{category}/{post}',[PostController::class, 'show']);
