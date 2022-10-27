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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/admin/tours', [TourController::class, 'all']);
Route::post('/admin/tours', [TourController::class, 'store']);
Route::put('/admin/tours', [TourController::class, 'store']);
Route::delete('/admin/tours/{id}', [TourController::class, 'remove']);
Route::post('/admin/tours/{id}/featured', [TourController::class, 'toggleFeatured']);

// Tailor Made Safari endpoint
Route::post('/admin/tailored/booking', [TourController::class, 'TailorMadeBooking']);
// Safari Enquiry endpoint
Route::post('/admin/tour/enquiry', [TourController::class, 'TourEnquiry']);

Route::delete('/admin/tour-day/{id}', [D2dController::class, 'remove']);

Route::get('/admin/tour-categories', [TourCategoryController::class, 'all4api']);

Route::get('/admin/destination-categories', [DestinationCategoryController::class, 'all4api']);
