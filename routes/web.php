<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PagesController;


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


Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('page.index');


Route::get('/trening', [App\Http\Controllers\PagesController::class, 'training'])->name('page.training');

Route::get('/import', [App\Http\Controllers\PagesController::class, 'importView'])->name('page.import.view');

Route::post('/import/process', [App\Http\Controllers\PagesController::class, 'importProcess'])->name('page.import.process');



Route::get('/admin/kokpit', [AdminController::class, 'kokpit'])->name('admin.kokpit');

