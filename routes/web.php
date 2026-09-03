<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\TextpagesController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\ConfigurationsController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ServicesController as ClientServicesController;
use App\Http\Controllers\Client\ToursController as ClientToursController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\TourCategoriesController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\ToursIndexController;

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
// Route::get('/api', [IndexController::class, 'index']);

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
   Route::get('/',[HomeController::class,'index'])->name('ClientHome');
   Route::get('/about',[AboutController::class,'index'])->name('ClientAbout');
   Route::get('/contact',[ContactController::class,'index'])->name('ClientContact');
   Route::get('/service/{id}',[ClientServicesController::class,'inner'])->name('ClientServiceInner');
   Route::get('/services',[ClientServicesController::class,'index'])->name('ClientServices');
   Route::get('/tours',[ClientToursController::class,'index'])->name('ClientTours');
   Route::get('/tour/{tour}',[ClientToursController::class,'inner'])->name('ClientTourInner');
});

Route::get('/admin/login', [LoginController::class, 'index'])->middleware('AdminLogin')->name('LoginPageAdmin');
Route::post('/admin/singin', [LoginController::class, 'singin'])->middleware('AdminLogin')->name('LoginAdmin');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('LogoutAdmin');

Route::middleware(['admin', 'check_permission'])->group(function () {

    Route::prefix('admin')->group(function () {

        // ადმინისტრატორის პანელის მთავარი გვერდი
        Route::get('/', [AdminIndexController::class, 'index'])->name('AdminMainPage');

        /*
         * ყველა მოდულისათვის საერთო მეთოდები
         */

        // integer ტიპის ისეთი ველების განახლება, რომელთა შესაძლო მნიშვნელობებიცაა 0 და 1
        Route::post('status', [BaseController::class, 'status'])->name('Status');
        // წაშლა
        Route::post('/remove', [BaseController::class, 'remove'])->name('Remove');
        // სტატუსის შეცვლა რამოდენიმე ელემენტზე ერთდროულად ან მათი წაშლა
        Route::post('/multi', [BaseController::class, 'multi'])->name('Multi');
        // თანმიმდევრობის შეცვლა ჩამონათვალის გვერდზე
        Route::post('/ordering', [BaseController::class, 'ordering'])->name('Ordering');
        // მიმაგრებული ფაილის წაშლა და შესაბამისი ველის მნიშვნელობად null
        Route::post('/remove_file', [BaseController::class, 'remove_file'])->name('RemoveFile');
        // ფოტოს წაშლა გალერიიდან
        Route::post('/remove_image_from_gallery', [BaseController::class, 'remove_image_from_gallery'])->name('RemoveImageFromGallery');
        // ვიდეოს წაშლა გალერიიდან
        Route::post('/remove_video_from_gallery', [BaseController::class, 'remove_video_from_gallery'])->name('RemoveVideoFromGallery');

        Route::prefix('tours')->group(function () {

            Route::get('/', [ToursIndexController::class, 'index'])->name('ToursIndex');

            // ტური
            Route::prefix('/tours')->group(function () {
                Route::get('/', [TourController::class, 'index'])->name('Tours');
                Route::get('/add', [TourController::class, 'create'])->name('AddTours');
                Route::post('create', [TourController::class, 'store'])->name('StoreTours');
                Route::get('/edit/{id}/{page?}', [TourController::class, 'edit'])->name('EditTours');
                Route::post('update/{id}', [TourController::class, 'update'])->name('UpdateTours');
                Route::post('/remove_color_images', [TourController::class, 'RemoveColorImages'])->name('RemoveColorImageTours');
                Route::get('/search', [TourController::class, 'search'])->name('SearchTours');
                Route::post('/livesearch', [TourController::class, 'live_search'])->name('LiveSearchTours');
                Route::get('/import', [TourController::class, 'import'])->name('ImportTours');
                Route::post('/import', [TourController::class, 'upload'])->name('UploadTours');
            });

            // კატეგორიები
            Route::prefix('/categories')->group(function () {
                Route::get('/', [TourCategoriesController::class, 'index'])->name('TourCategories');
                Route::get('/add', [TourCategoriesController::class, 'create'])->name('AddTourCategories');
                Route::post('create', [TourCategoriesController::class, 'store'])->name('StoreTourCategories');
                Route::get('/edit/{id}', [TourCategoriesController::class, 'edit'])->name('EditTourCategories');
                Route::post('update/{id}', [TourCategoriesController::class, 'update'])->name('UpdateTourCategories');
            });

        });

        // სლაიდერი
        Route::prefix('sliders')->group(function () {
            Route::get('/', [SlidersController::class, 'index'])->name('Sliders');
            Route::get('/add', [SlidersController::class, 'create'])->name('AddSliders');
            Route::post('create', [SlidersController::class, 'store'])->name('StoreSliders');
            Route::get('/edit/{id}', [SlidersController::class, 'edit'])->name('EditSliders');
            Route::post('update/{id}', [SlidersController::class, 'update'])->name('UpdateSliders');
        });

        // ჩვენ შესახებ
        Route::prefix('about')->group(function () {
            Route::get('/', [TextpagesController::class, 'edit'])->name('Textpages');
            Route::get('/edit/{id}', [TextpagesController::class, 'edit'])->name('EditTextpages');
            Route::post('update/{id}', [TextpagesController::class, 'update'])->name('UpdateTextpages');
        });

        Route::prefix('services')->group(function () {
            Route::get('/', [ServicesController::class, 'index'])->name('Services');
            Route::get('/add', [ServicesController::class, 'create'])->name('AddServices');
            Route::post('create', [ServicesController::class, 'store'])->name('StoreServices');
            Route::get('/edit/{id}', [ServicesController::class, 'edit'])->name('EditServices');
            Route::post('update/{id}', [ServicesController::class, 'update'])->name('UpdateServices');
        });


        // ამ გვერდებზე შესვლის უფლება აქვს მხოლოდ სუპერადმინს
        Route::middleware('check_if_super')->group(function () {

            // საკონტაქტო ინფორმაციის გვერდი
            Route::prefix('informations')->group(function () {
                Route::get('/', [InformationController::class, 'edit'])->name('EditInformations');
                Route::post('/update/{id}', [InformationController::class, 'update'])->name('UpdateInformations');
            });


            // ადმინისტრატორები
            Route::prefix('admins')->group(function () {
                Route::get('/', [AdminsController::class, 'index'])->name('Admins');
                Route::get('/add', [AdminsController::class, 'create'])->name('AddAdmins');
                Route::post('create', [AdminsController::class, 'store'])->name('StoreAdmins');
                Route::get('/edit/{id}', [AdminsController::class, 'edit'])->name('EditAdmins');
                Route::post('update/{id}', [AdminsController::class, 'update'])->name('UpdateAdmins');
                Route::post('remove', [AdminsController::class, 'remove'])->name('RemoveAdmins');
            });

            // საიტის კონფიგურაციული პარამეტრები
            Route::prefix('configuration')->group(function () {
                Route::get('/', [ConfigurationsController::class, 'edit'])->name('EditConfigurations');
                Route::post('/update/{id}', [ConfigurationsController::class, 'update'])->name('UpdateConfigurations');
                Route::get('/remove_cache_key/{key}', [ConfigurationsController::class, 'remove_cache_key'])->name('RemoveCacheKeyConfigurations');
            });
        });
    });
});

