<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Auth;
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


Route::middleware('auth') ->prefix('admin-form')->group(function (){

    Route::get('/', [HomeController::class, 'index'])->name('admin');

    Route::prefix('company')->group(function (){
        Route::get('/', [CompanyController::class, 'index'])->name('company');
        Route::get('/show/{id}', [CompanyController::class, 'show'])->name('company-show');
        Route::get('create/', [CompanyController::class, 'create'])->name('company-create');
        Route::post('create/', [CompanyController::class, 'store'])->name('company-store');
        Route::get('edit/{id}', [CompanyController::class, 'edit'])->name('company-edit');
        Route::put('update/{id}', [CompanyController::class, 'update'])->name('company-update');
        Route::get('delete/{id}', [CompanyController::class, 'destroy'])->name('company-delete');
        Route::get('create_client/{id_company}', [CompanyController::class, 'createClient'])->name('company-createClient');
        Route::get('delete_client/{id}/{id_company}', [CompanyController::class, 'destroyClient'])->name('company-deleteClient');
    });

    Route::prefix('client')->group(function (){
        Route::get('/', [ClientController::class, 'index'])->name('client');
        //Route::get('create/', [ClientController::class, 'index'])->name('client-create');
        Route::post('create/', [ClientController::class, 'store'])->name('client-store');
        Route::get('edit/{id}', [ClientController::class, 'edit'])->name('client-edit');
        Route::put('update/{id}', [ClientController::class, 'update'])->name('client-update');
        Route::get('delete/{id}', [ClientController::class, 'destroy'])->name('client-delete');
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return redirect(route('admin'));
});

