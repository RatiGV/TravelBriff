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
use App\Http\Controllers\Client\RoomsController as ClientRoomsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\ProductCategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductInnerController;
use App\Http\Controllers\Admin\ProductsController;

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
   Route::get('/rooms',[ClientRoomsController::class,'index'])->name('ClientRooms');
   Route::get('/room/{room}',[ClientRoomsController::class,'inner'])->name('ClientRoomInner');
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

        Route::prefix('rooms')->group(function () {

            Route::get('/', [ProductsController::class, 'index'])->name('ProductsIndex');

            // პროდუქტი
            Route::prefix('/rooms')->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('Products');
                Route::get('/add', [ProductController::class, 'create'])->name('AddProducts');
                Route::post('create', [ProductController::class, 'store'])->name('StoreProducts');
                Route::get('/edit/{id}/{page?}', [ProductController::class, 'edit'])->name('EditProducts');
                Route::post('update/{id}', [ProductController::class, 'update'])->name('UpdateProducts');
                Route::post('/remove_color_images', [ProductController::class, 'RemoveColorImages'])->name('RemoveColorImageProducts');
                Route::get('/search', [ProductController::class, 'search'])->name('SearchProducts');
                Route::post('/livesearch', [ProductController::class, 'live_search'])->name('LiveSearchProducts');
                Route::get('/import', [ProductController::class, 'import'])->name('ImportProducts');
                Route::post('/import', [ProductController::class, 'upload'])->name('UploadProducts');
            });

            // კატეგორიები
            Route::prefix('/categories')->group(function () {
                Route::get('/', [ProductCategoriesController::class, 'index'])->name('ProductCategories');
                Route::get('/add', [ProductCategoriesController::class, 'create'])->name('AddProductCategories');
                Route::post('create', [ProductCategoriesController::class, 'store'])->name('StoreProductCategories');
                Route::get('/edit/{id}', [ProductCategoriesController::class, 'edit'])->name('EditProductCategories');
                Route::post('update/{id}', [ProductCategoriesController::class, 'update'])->name('UpdateProductCategories');
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

