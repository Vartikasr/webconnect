<?php
use App\Http\Middleware\CheckStatus;
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

Route::get('/', function () {
    return view('welcome');
});


//register

Route::get('/register' , [AuthController::class , 'register']);
Route::post('/checkEmail' , [AuthController::class , 'checkEmail']);
Route::post('/store-register' , [AuthController::class , 'storeRegister']);
Route::get('/login' , [AuthController::class , 'login']);
Route::post('/checklogin' , [AuthController::class , 'checklogin']);
Route::post('/logout' , [AuthController::class , 'logout']);

//dashboard routes

Route::middleware([CheckStatus::class])->group(function(){

    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::get('/profile' , [HomeController::class , 'profile']);
    Route::post('/update_profile' , [HomeController::class , 'update']);
    Route::get('/users' , [HomeController::class , 'users']);
});


