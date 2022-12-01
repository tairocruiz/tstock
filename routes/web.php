<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//======= Admin Controllers ================================================================.
    use App\Http\Controllers\Safaris\TourController as AfarisTourController;
    use App\Http\Controllers\Safaris\TourCategoryController As AfarisTourCategoryController;
    use App\Http\Controllers\Safaris\DestinationCategoryController As AfarisDestinationCategoryController;
    use App\Http\Controllers\Safaris\PageController As AfarisPageController;
    use App\Http\Controllers\Safaris\HomeController As AfarisHomeController;
    use App\Http\Controllers\Safaris\DestinationController As AfarisDestinationController;
    use App\Http\Controllers\Safaris\PostController As AfarisPostController;
    use App\Http\Controllers\Safaris\PostCategoryController As AfarisPostCategoryController;
    use App\Http\Controllers\Safaris\PhotoController As AfarisPhotoController;
//======= Guest Controllers ================================================================.
    use App\Http\Controllers\PostCategoryController;
    use App\Http\Controllers\DestinationController;
    use App\Http\Controllers\DestinationCategoryController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\TourCategoryController;
    use App\Http\Controllers\TourController;
    use App\Http\Controllers\PhotoController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

//----------------------------------------------------------------------------------------------------------------------

// Route::get('/admin/pages', [PageController::class, 'all']);
// Route::get('/admin/pages/add', [PageController::class, 'add']);
// Route::post('/admin/pages', [PageController::class, 'store']);
// Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit']);
// Route::put('/admin/pages/{page}', [PageController::class, 'update']);
// Route::delete('/admin/pages/{page}', [PageController::class, 'remove']);
//----------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------------------

// Route::get('/admin/photos',[PhotoController::class, 'all']);
// Route::get('/admin/photos/add',[PhotoController::class, 'add']);
// Route::post('/admin/photos',[PhotoController::class, 'store']);
// Route::get('/admin/photos/{photo}/edit',[PhotoController::class, 'edit']);
// Route::put('/admin/photos/{photo}',[PhotoController::class, 'update']);
// Route::delete('/admin/photos/{photo}',[PhotoController::class, 'remove']);
//----------------------------------------------------------------------


//----------------------------------------------------------------------

// Route::get('/admin/places', [DestinationController::class, 'all']);
// Route::get('/admin/places/add',[DestinationController::class, 'add']);
// Route::post('/admin/places', [DestinationController::class, 'store']);
// Route::get('/admin/places/{place}/edit', [DestinationController::class, 'edit']);
// Route::put('/admin/places/{place}', [DestinationController::class, 'update']);
// Route::delete('/admin/places/{place}', [DestinationController::class, 'remove']);
//----------------------------------------------------------------------
//Route::get('/tanzania/destinations', [DestinationController::class, 'index']);

//----------------------------------------------------------------------

// //----------------------------------------------------------------------
// Route::get('/admin/destination-categories/', [DestinationCategoryController::class, 'all']);
// Route::get('/admin/destination-categories/add', [DestinationCategoryController::class, 'add']);
// Route::post('/admin/destination-categories/', [DestinationCategoryController::class, 'store']);
// Route::get('/admin/destination-categories/{category}/edit', [DestinationCategoryController::class, 'edit']);
// Route::put('/admin/destination-categories/{category}', [DestinationCategoryController::class, 'update']);
// Route::delete('/admin/destination-categories/{category}', [DestinationCategoryController::class, 'remove']);

//----------------------------------------------------------------------

// Route::get('/admin/tour-categories/', [TourCategoryController::class, 'all']);
// Route::get('/admin/tour-categories/add', [TourCategoryController::class, 'add']);
// Route::post('/admin/tour-categories/', [TourCategoryController::class, 'store']);
// Route::get('/admin/tour-categories/{category}/edit', [TourCategoryController::class, 'edit']);
// Route::put('/admin/tour-categories/{category}/', [TourCategoryController::class, 'update']);
// Route::delete('/admin/tour-categories/{category}/', [TourCategoryController::class, 'remove']);
// //----------------------------------------------------------------------

//----------------------------------------------------------------------

//Route::get('/admin/tours', function (){ return view('admin.tours.all'); });

// Route::get('/admin/tours/add', [TourController::class, 'add']);
// Route::post('/admin/tours/', [TourController::class, 'store']);
// Route::get('/admin/tours/{tour}/edit', [TourController::class, 'edit']);
// Route::put('/admin/tours/{tour}', [TourController::class, 'update']);
// Route::delete('/admin/tours/{tour}', [TourController::class, 'remove']);
// Route::get('/admin/tours/{tour}/{featured}', [TourController::class, 'changeFeaturedStatus']);
// //---------------------------------------------------------------------


//----------------------------------------------------------------------------------------------------------------------

// Route::get('/admin/post-categories', [PostCategoryController::class, 'all']);
// Route::get('/admin/post-categories/add', [PostCategoryController::class, 'add']);
// Route::post('/admin/post-categories', [PostCategoryController::class, 'store']);
// Route::get('/admin/post-categories/{category}/edit', [PostCategoryController::class, 'edit']);
// Route::put('/admin/post-categories/{category}', [PostCategoryController::class, 'update']);
// Route::delete('/admin/post-categories/{category}', [PostCategoryController::class, 'remove']);
//---------------------------------------------------------------------


//----------------------------------------------------------------------------------------------------------------------

// Route::get('/admin/posts', [PostController::class, 'all']);
// Route::get('/admin/posts/add', [PostController::class, 'add']);
// Route::post('/admin/posts/', [PostController::class, 'store']);
// Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit']);
// Route::put('/admin/posts/{post}', [PostController::class, 'update']);
// Route::delete('/admin/posts/{post}', [PostController::class, 'remove']);
//---------------------------------------------------------------------

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resources([
        'places' => AfarisDestinationController::class,
        'destination-categories' => AfarisDestinationCategoryController::class,
        'post-categories' => AfarisPostCategoryController::class,
        'posts' => AfarisPostController::class,
        'pages' => AfarisPageController::class,
        'tours' => AfarisTourController::class,
        'tour-categories' => AfarisTourCategoryController::class,
        'photos' => AfarisPhotoController::class,
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

//================ Pages ===================================================
    Route::get('/', [PageController::class, 'home']);
    Route::get('/{page}', [PageController::class, 'show']);
    //Route::post('/safari/booking', [PageController::class, 'booking']);
    Route::post('/safari/booking', 'App\Http\Controllers\PageController@booking');
    Route::any('/safari/contacts', [PageController::class, 'contacts']);

//=================  Photo =================================================
    Route::get('/tour/gallery', [PhotoController::class, 'index']);

// ================= Destinations  =========================================
    Route::get('/destinations/{d}', [DestinationController::class, 'show']);

// ================ Destination Categories  =========================================
    Route::get('/tanzania/places-to-go', [DestinationCategoryController::class, 'index']);
    Route::get('/places-to-go/{area}', [DestinationCategoryController::class, 'show']);

// ===============  Tour Categories  =========================================
    Route::get('/tanzania/safaris/', [TourCategoryController::class, 'index']);
    Route::get('/safaris/{s}/', [TourCategoryController::class, 'show']);

// ================ Tours ===========================================
    Route::get('/tours/{t}', [TourController::class, 'show']);
    Route::get('/safari-tours/tailor-made', [TourController::class, 'tailorMade']);
    // Route::get('/safari-tours/tailor-made', function () {
    //     return view('front.tours.tailor-made', ['title' => 'Tailor Made Safari Tours in Tanzania Africa']);
    // });

// ================= Posts Categories =====================================================
    Route::get('/tourism/blog',[PostCategoryController::class, 'index']);
    Route::get('/tourism/blog/{category}',[PostCategoryController::class, 'show']);

// ================== Posts  =======================================================
    Route::get('/{category}/{post}',[PostController::class, 'show']);

});

Route::any('/{any}', [AfarisHomeController::class, 'index']);
