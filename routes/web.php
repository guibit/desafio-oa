<?php

use App\Http\Controllers\Ordered;
use App\Http\Controllers\Products;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->resource('products',Products::class);

Route::middleware(['auth:sanctum', 'verified'])->resource('ordereds',Ordered::class)->except([
    'show' ,'edit','create'
]);
Route::get('/trolley',[Ordered::class,'show'])->middleware(['auth:sanctum', 'verified'])
    ->name('ordered.show');
Route::post('/trolley',[Ordered::class,'save'])->middleware(['auth:sanctum', 'verified'])
    ->name('ordered.save');

Route::middleware(['auth:sanctum', 'verified'])->get('/user/products',[UserController::class,'products'])
    ->name('user.products');



