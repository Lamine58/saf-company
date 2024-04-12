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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ValueChainController;
use App\Http\Controllers\QuizzeController;
use App\Http\Controllers\RegionController;


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

    Route::get('/liste-des-fournisseurs', [BusinessController::class, 'index'])->name('business.index');
    Route::get('/fournisseur/{id}', [BusinessController::class, 'add'])->name('business.add');
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
    Route::get('/liste-des-questions/{quizze_id}', [IndicatorController::class, 'index'])->name('indicator.index');
    Route::get('/indicateur/{indicateur_id}/{quizze_id}', [IndicatorController::class, 'add'])->name('indicator.add');
    Route::post('/save-indicator', [IndicatorController::class, 'save'])->name('indicator.save');
    Route::get('/delete-indicator', [IndicatorController::class, 'delete'])->name('indicator.delete');




    #role
    Route::get('/liste-des-roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/{id}', [RoleController::class, 'add'])->name('role.add');
    Route::get('/role/permissions/{id}', [RoleController::class, 'permissions'])->name('role.permissions');
    Route::post('/save-role', [RoleController::class, 'save'])->name('role.save');
    Route::get('/delete-role', [RoleController::class, 'delete'])->name('role.delete');


    #permission
    Route::get('/liste-des-permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/{id}', [PermissionController::class, 'add'])->name('permission.add');
    Route::post('/save-permission', [PermissionController::class, 'save'])->name('permission.save');
    Route::post('/set-permission', [PermissionController::class, 'set_permission'])->name('set-permission.save');
    Route::get('/delete-permission', [PermissionController::class, 'delete'])->name('permission.delete');
    
    #chaine de valeur
    Route::get('/liste-des-chaines-de-valeurs', [ValueChainController::class, 'index'])->name('value-chain.index');
    Route::get('/chaine-de-valeur/{id}', [ValueChainController::class, 'add'])->name('value-chain.add');
    Route::post('/save-value-chain', [ValueChainController::class, 'save'])->name('value-chain.save');
    Route::get('/delete-value-chain', [ValueChainController::class, 'delete'])->name('value-chain.delete');


    #questionnaire
    Route::get('/liste-des-questionnaires/{category_id}', [QuizzeController::class, 'index'])->name('quizze.index');
    Route::get('/questionnaire/{id}', [QuizzeController::class, 'add'])->name('quizze.add');
    Route::post('/save-quizze', [QuizzeController::class, 'save'])->name('quizze.save');
    Route::get('/delete-quizze', [QuizzeController::class, 'delete'])->name('quizze.delete');

    #region
    Route::get('regions/{region_id}/departements', [RegionController::class, 'departements'])->name('departements.by_region');
    Route::get('categories/{category_ids}', [CategoryController::class, 'categories'])->name('categories.by_ids');
    
    
});