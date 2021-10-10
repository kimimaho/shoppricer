<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\NotificationController;

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

Route::get('/strategies', [UserController::class, 'strategie'])->name('strategie.create');
Route::post('/strategies', [UserController::class, 'update'])->name('strategie.update');
Route::resource('/produits', ProduitController::class);
Route::resource('/offres', OffreController::class);
Route::post('/offres/importations', [OffreController::class, 'importation'])->name('importation-offres');
Route::resource('/notifications', NotificationController::class);
Route::post('import', [ProduitController::class, 'import'])->name('importation');
Route::get('repositionnement/{id}', [ProduitController::class, 'repositionnement'])->name('repositionnement');
Route::post('excecuter', [ProduitController::class, 'excecuter'])->name('produits.excecuter');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
