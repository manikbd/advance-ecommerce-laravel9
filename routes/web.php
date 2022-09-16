<?php
use App\Models\User; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
// use App\Http\Controllers\Backend\CategoryController;
// use App\Http\Controllers\Backend\SubCategoryController;
// use App\Http\Controllers\Backend\ProductController;
// use App\Http\Controllers\Backend\SliderController;
// use App\Http\Controllers\Backend\CouponController;
// use App\Http\Controllers\Backend\ShippingAreaController;
// use App\Http\Controllers\Backend\OrderController;
// use App\Http\Controllers\Backend\ReportController;
// use App\Http\Controllers\Backend\BlogController;
// use App\Http\Controllers\Backend\SiteSettingController;
// use App\Http\Controllers\Backend\ReturnController;
// use App\Http\Controllers\Backend\AdminUserController;

// use App\Http\Controllers\Frontend\LanguageController;
// use App\Http\Controllers\Frontend\CartController;
// use App\Http\Controllers\Frontend\HomeBlogController;

// use App\Http\Controllers\User\WishlistController;
// use App\Http\Controllers\User\CartPageController;
// use App\Http\Controllers\User\CheckoutController;
// use App\Http\Controllers\User\StripeController;
// use App\Http\Controllers\User\CashController;
// use App\Http\Controllers\User\ReviewController;
// use App\Http\Controllers\User\AllUserController;
// use App\Http\Controllers\Frontend\ShopController;

//Frontend Controller
use App\Http\Controllers\Frontend\IndexController;

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


Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});




Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');

// Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
// User ALL Routes

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
	$id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');

//Frontend
Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');

// Admin Brand All Routes 

Route::prefix('brand')->group(function(){
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
    });
