<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsuranceTypeController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\SimulatorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CRMController;

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
Route::get('/simulateur', [SimulatorController::class, 'index'])->name('simulator.index');
Route::get('/type-assurance/{id}/insurance-types', [InsuranceTypeController::class, 'insurance_types']);
Route::get('/type-assurance/{id}/formules', [InsuranceTypeController::class, 'formules']);
Route::get('/type-assurance/{formule_name}/{insurance_type_id}/conditions', [InsuranceTypeController::class, 'conditions']);
Route::get('/type-assurance/{insurance_type_id}/options', [InsuranceTypeController::class, 'options']);
Route::get('/type-assurance/{option}/{insurance_type_id}/insurance-types-data', [InsuranceTypeController::class, 'insurance_types_data']);

Route::middleware(['auth'])->group(function () {

    Route::get('/deconnexion', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    #crm
    Route::get('/crm', [CRMController::class, 'index'])->name('crm');
    Route::get('/relance-mail', [CRMController::class, 'mail'])->name('crm.mail');
    Route::get('/relance-sms', [CRMController::class, 'sms'])->name('crm.sms');
    Route::post('/send-mail', [CRMController::class, 'send_mail'])->name('crm.send-mail');
    Route::post('/send-sms', [CRMController::class, 'send_sms'])->name('crm.send-sms');
    Route::get('/delete-mail', [CRMController::class, 'delete_mail'])->name('crm.delete-mail');
    Route::get('/delete-sms', [CRMController::class, 'delete_sms'])->name('crm.delete-sms');

    #utilisateur
    Route::get('/liste-des-utilisateurs', [UserController::class, 'index'])->name('user.index');
    Route::get('/utilisateur/{id}', [UserController::class, 'add'])->name('user.add');
    Route::post('/save-user', [UserController::class, 'save'])->name('user.save');
    Route::get('/delete-user', [UserController::class, 'delete'])->name('user.delete');

    #assurance
    Route::post('/save-insurance', [InsuranceController::class, 'save'])->name('insurance.save');
    Route::get('/delete-insurance', [InsuranceController::class, 'delete'])->name('insurance.delete');

    #ype d'assurance
    Route::get('/liste-type-assurance', [InsuranceTypeController::class, 'index'])->name('insurance-type.index');
    Route::get('/type-assurance/{id}', [InsuranceTypeController::class, 'add'])->name('insurance-type.add');
    Route::post('/save-insurance-type', [InsuranceTypeController::class, 'save'])->name('insurance-type.save');
    Route::get('/delete-insurance-type', [InsuranceTypeController::class, 'delete'])->name('insurance-type.delete');

    #client
    Route::get('/liste-clients', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/client/{id}', [CustomerController::class, 'add'])->name('customer.add');
    Route::post('/save-customer', [CustomerController::class, 'save'])->name('customer.save');
    Route::get('/delete-customer', [CustomerController::class, 'delete'])->name('customer.delete');
  
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
    
});