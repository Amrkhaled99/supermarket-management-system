<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/categories', [CategoryController::class,'index']);
// Route::get('/categories', [CategoryController::class,'index']);



Route::resource('/products', ProductController::class);

Route::resource('/categories', CategoryController::class);

Route::resource('/employees', EmployeeController::class);
Auth::routes();

Route::get('/login', [AuthController::class,"login"]);
Route::get('/register', [AuthController::class,"register"]);
Route::post('/register-user', [AuthController::class,"registerUser"])->name("register-user");
Route::post('/login-user', [AuthController::class,"loginUser"])->name("login-user");




// Route::middleware('auth:sanctum')->prefix('/user')->group(function () {
  
// });


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/customers', CustomerController::class);
    Route::post('/logout-user', [AuthController::class,"logoutUser"])->name("logout-user");



});




Route::prefix("user")->name('user')->group(function(){

    Route::middleware(['guest'])->group(function(){
        
    });

    
    Route::middleware(['auth'])->group(function(){
        
    });
});