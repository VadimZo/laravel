<?php


use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix'=>'/admin/','middleware'=>'admin'],function(){
    Route::get('/', [AdminController::class,'index']);
    Route::resource('/posts', PostController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/users', UserController::class);
    Route::get('/comments', [CommentController::class,'index']);
    Route::get('/toggle/{id}',[CommentController::class,'toggle'])->name('toggle');
});



Route::get('/',[HomeController::class,'index']);
Route::get('/post/{slug}',[HomeController::class,'show'])->name('post.show');
Route::get('/categories/{slug}',[HomeController::class,'categories'])->name('post.category');
Route::get('/tags/{slug}',[HomeController::class,'tags'])->name('post.tags');
Route::post('/comment',[\App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
Route::post('/subscription',[\App\Http\Controllers\SubscriptionController::class,'subs'])->name('subscription');
Route::get('/subscription/{token}',[\App\Http\Controllers\SubscriptionController::class,'verify'])->name('verify');

Route::group(['middleware'=>'guest'],function(){
    Route::get('/login',[\App\Http\Controllers\HomeController::class,'login']);
    Route::get('/register',[\App\Http\Controllers\HomeController::class,'register']);
    Route::post('/register',[AuthController::class,'registerForm'])->name('register.create');
    Route::post('/login',[AuthController::class,'loginForm'])->name('login');
});


Route::group(['middleware'=>'auth'],function(){
    Route::get('/profile',[\App\Http\Controllers\ProfileController::class,'index']);
    Route::post('/profile',[\App\Http\Controllers\ProfileController::class,'store'])->name('profile.store');
    Route::get('/logout',[AuthController::class,'logout']);
});


Route::get('/guzzle',[\App\Http\Controllers\guzzleController::class,'index']);
Route::get('/ajax',[\App\Http\Controllers\ajaxController::class,'index']);
Route::post('/ajax',[\App\Http\Controllers\ajaxController::class,'create'])->name('ajax');


