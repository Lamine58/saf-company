<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\UnityController;
use App\Http\Controllers\PeriodicityController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndicatorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/connexion', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::middleware(['auth'])->group(function () {

    Route::get('/deconnexion', [AuthController::class, 'logout'])->name('logout');
        
    Route::get('/', function () {
        return view('dashboard.index');
    });

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    #utilisateur
    Route::get('/liste-des-utilisateurs', [UserController::class, 'index'])->name('user.index');
    Route::get('/utilisateur/{id}', [UserController::class, 'add'])->name('user.add');
    Route::post('/save-user', [UserController::class, 'save'])->name('user.save');
    Route::get('/delete-user', [UserController::class, 'delete'])->name('user.delete');


    Route::middleware(['admin'])->group(function () {

        Route::get('/liste-des-etablissements', [BusinessController::class, 'index'])->name('business.index');
        Route::get('/etablissement/{id}', [BusinessController::class, 'add'])->name('business.add');
        Route::post('/save-business', [BusinessController::class, 'save'])->name('business.save');
        Route::delete('/delete-business', [BusinessController::class, 'delete'])->name('business.delete');
            
        #methode
        Route::get('/liste-des-methode-de-collecte-des-donnees', [MethodController::class, 'index'])->name('method.index');
        Route::post('/save-method', [MethodController::class, 'save'])->name('method.save');
        Route::get('/delete-method', [MethodController::class, 'delete'])->name('method.delete');
        
        #unité
        Route::get('/liste-des-unites-de-mesures', [UnityController::class, 'index'])->name('unity.index');
        Route::post('/save-unity', [UnityController::class, 'save'])->name('unity.save');
        Route::get('/delete-unity', [UnityController::class, 'delete'])->name('unity.delete');
        
        #periodicité
        Route::get('/liste-des-periodicites', [PeriodicityController::class, 'index'])->name('periodicity.index');
        Route::post('/save-periodicity', [PeriodicityController::class, 'save'])->name('periodicity.save');
        Route::get('/delete-periodicity', [PeriodicityController::class, 'delete'])->name('periodicity.delete');
        
        #zone
        Route::get('/liste-des-zones', [ZoneController::class, 'index'])->name('zone.index');
        Route::get('/zone/{id}', [ZoneController::class, 'add'])->name('zone.add');
        Route::post('/save-zone', [ZoneController::class, 'save'])->name('zone.save');
        Route::get('/delete-zone', [ZoneController::class, 'delete'])->name('zone.delete');
        
        #categorie
        Route::get('/liste-des-categories', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/categorie/{id}', [CategoryController::class, 'add'])->name('category.add');
        Route::post('/save-category', [CategoryController::class, 'save'])->name('category.save');
        Route::get('/delete-category', [CategoryController::class, 'delete'])->name('category.delete');
        
        #indicateur
        Route::get('/liste-des-indicateurs/{id}', [IndicatorController::class, 'index'])->name('indicator.index');
        Route::get('/indicateur/{indicateur_id}/{categorie_id}', [IndicatorController::class, 'add'])->name('indicator.add');
        Route::post('/save-indicator', [IndicatorController::class, 'save'])->name('indicator.save');
        Route::get('/delete-indicator', [IndicatorController::class, 'delete'])->name('indicator.delete');
        
    });

});