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
use App\Http\Controllers\SouscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransfertMoneyController;



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

    #souscription
    Route::get('/souscription/{id}', [SouscriptionController::class, 'add'])->name('souscription.add');
    Route::post('/save-souscription', [SouscriptionController::class, 'save'])->name('souscription.save');
    Route::get('/liste-souscription', [SouscriptionController::class, 'index'])->name('souscription.index');
    Route::get('/delete-souscription', [SouscriptionController::class, 'delete'])->name('souscription.delete');
    Route::get('/liste-souscription-expire', [SouscriptionController::class, 'expired'])->name('souscription.expired');
    Route::get('souscription/download/{id}', [SouscriptionController::class, 'downloadFile'])->name('souscription.downloadFile');

    Route::get('/edit-souscription/{id}', [SouscriptionController::class, 'edit'])->name('souscription.edit');
    Route::post('/save-edit-souscription', [SouscriptionController::class, 'save_edit'])->name('souscription.save_edit');

    
    #payment
    Route::get('/liste-payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/{id}', [PaymentController::class, 'add'])->name('payment.add');
    Route::post('/save-payment', [PaymentController::class, 'save'])->name('payment.save');
    Route::get('/delete-payment', [PaymentController::class, 'delete'])->name('payment.delete');

    Route::get('/edit-payment/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::post('/save-edit-payment', [PaymentController::class, 'save_edit'])->name('payment.save_edit');


    #transfert_money
    Route::get('/liste-transfert_argent', [TransfertMoneyController::class, 'index'])->name('transfert_money.index');
    Route::get('/transfert_argent', [TransfertMoneyController::class, 'add'])->name('transfert_money.add');
    Route::post('/import-transfert_argent', [TransfertMoneyController::class, 'import'])->name('transfert_money.import');
    Route::get('/delete-transfert_argent', [TransfertMoneyController::class, 'delete'])->name('transfert_argent.delete');

  
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