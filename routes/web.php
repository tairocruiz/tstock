<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//======= Admin Controllers ================================================================.
    use App\Http\Controllers\Safaris\TourController as AfarisTourController;
    use App\Http\Controllers\Safaris\TourCategoryController As AfarisTourCategoryController;
    use App\Http\Controllers\Safaris\DestinationCategoryController As AfarisDestinationCategoryController;
    use App\Http\Controllers\Safaris\PageController As AfarisPageController;
    use App\Http\Controllers\Safaris\DestinationController As AfarisDestinationController;
//======= Guest Controllers ================================================================.
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

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resources([
            'places' => AfarisDestinationController::class,
            'destination_categories' => AfarisDestinationCategoryController::class,
            'post_categories' => PostCategoryController::class,
            'posts' => PostController::class,
            'pages' => AfarisPageController::class,
            'tours' => AfarisTourController::class,
            'tour_categories' => AfarisTourCategoryController::class,
        ]);
});

Route::group(['prefix' => '', 'as' => 'front.'], function () {
        Route::resources([
            'places' => DestinationController::class,
            'destination_categories' => DestinationCategoryController::class,
            'post_categories' => PostCategoryController::class,
            'posts' => PostController::class,
            'pages' => PageController::class,
            'tours' => TourController::class,
            'tour_categories' => TourCategoryController::class,
        ]);

    //============ Destinations ===========================================================.
       Route::get('/places/{d}', [DestinationController::class, 'show']);
       Route::get('/destinations/{d}', [DestinationController::class, 'show']);
    //============ Destinations categories =================================================.
        Route::get('/tanzania/places-to-go', [DestinationCategoryController::class, 'index']);
        Route::get('/places-to-go/{area}', [DestinationCategoryController::class, 'show']);
    //============ Post categories ========================================================.
        Route::get('/tourism/blog', [PostCategoryController::class, 'index']);
        Route::get('/tourism/blog/{category}', [PostCategoryController::class, 'show']);
    //============ Pages ==================================================================.
        Route::get('/', [PageController::class, 'home']); // <<<--- starter
        Route::get('/{page}', [PageController::class, 'show']);
        Route::get('/tour/gallery', [PageController::class, 'gallery']);
        Route::post('/safari/booking', [PageController::class, 'booking']);
        Route::any('/safari/contacts', [PageController::class, 'contacts']);
    //============ Tours =================================================================.
        Route::get('/tours/{t}', [TourController::class, 'show']);
    //============ Tour categories =======================================================.
        Route::get('/safaris/{s}/', [TourCategoryController::class, 'show']);
        Route::get('/tanzania/safaris/', [TourCategoryController::class, 'index']);
    //============ Posts =================================================================.
        //Route::get('/{category}/{post}',[PostController::class, 'show']);
        Route::any('/safari/cont', [PageController::class, 'aman']);

       // Route::get('inventory/receipts/{receipt}/product/{receivedproduct}/edit', ['as' => 'receipts.product.edit', 'uses' => 'DestinationController@show']);

});
//Route::get('inventory/receipts/{receipt}/product/{receivedproduct}/edit', ['as' => 'receipts.product.edit', 'DestinationController@index']);



