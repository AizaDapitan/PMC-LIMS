<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DeptUserController;
use App\Http\Controllers\DeptOfficerController;
use App\Http\Controllers\QAQCRecieverController;
use App\Http\Controllers\TransmittalItemController;

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

Route::get('/', [LoginController::class, 'index'])->name("login");
Route::post('auth/login', [LoginController::class, 'login'])->name("auth.login");

Route::middleware(['auth'])->group(function () {

    Route::get('logout', [LoginController::class, 'logout'])->name("logout");

    // Dept User Controller
    Route::group(
        ['prefix' => 'deptuser'], 
        function () {
            Route::get('/dashboard', [DeptUserController::class, 'index'])->name("deptuser.index");
            Route::get('/unsaved-transmittal', [DeptUserController::class, 'unsavedTrans'])->name("deptuser.unsavedTrans");
            Route::post('/getUnsavedTrans', [DeptUserController::class, 'getUnsaved'])->name("deptuser.getUnsaved");
            Route::post('/getDeptUsers', [DeptUserController::class, 'getDeptUsers'])->name("deptuser.getDeptUsers");
            Route::get('/create-transmittal', [DeptUserController::class, 'create'])->name("deptuser.create");
            Route::post('/autosave', [DeptUserController::class, 'autosave'])->name("deptuser.autosave");
            Route::get('/edit-transmittal/{id}', [DeptUserController::class, 'edit'])->name("deptuser.edit");
            Route::post('/store', [DeptUserController::class, 'store'])->name("deptuser.store");
            Route::post('/update', [DeptUserController::class, 'update'])->name("deptuser.update");
            Route::post('/delete', [DeptUserController::class, 'delete'])->name("deptuser.delete");
            Route::get('/view-transmittal/{id}', [DeptUserController::class, 'view'])->name("deptuser.view");
    });
    Route::group(
        ['prefix' => 'transItem'], 
        function () {
            Route::post('/store', [TransmittalItemController::class, 'store'])->name("transItem.store");
            Route::post('/getItems', [TransmittalItemController::class, 'getItems'])->name("transItem.getItems");
            Route::post('/uploaditems', [TransmittalItemController::class, 'uploadItems'])->name("transItem.uploadItems");
            Route::post('/delete', [TransmittalItemController::class, 'delete'])->name("transItem.delete");
            Route::post('/update', [TransmittalItemController::class, 'update'])->name("transItem.update");
    });

    // Dept Officer Controller
    Route::group(
        ['prefix' => 'deptofficer'], 
        function () {
            Route::get('/dashboard', [DeptOfficerController::class, 'index'])->name("deptofficer.index");
            Route::post('/getDeptOfficers', [DeptOfficerController::class, 'getDeptOfficers'])->name("deptofficer.getDeptOfficers");
            Route::get('/edit-transmittal/{id}', [DeptOfficerController::class, 'edit'])->name("deptofficer.edit");
            Route::post('/update', [DeptOfficerController::class, 'update'])->name("deptofficer.update");
            Route::get('/view-transmittal/{id}', [DeptOfficerController::class, 'view'])->name("deptofficer.view");
    });  
       // QA/QC Receiver Controller
       Route::group(
        ['prefix' => 'qaqcreceiver'], 
        function () {
            Route::get('/dashboard', [QAQCRecieverController::class, 'index'])->name("qaqcreceiver.index");
            Route::post('/getTransmittal', [QAQCRecieverController::class, 'getTransmittal'])->name("qaqcreceiver.getTransmittal");
            Route::get('/view-transmittal/{id}', [QAQCRecieverController::class, 'view'])->name("qaqcreceiver.view");
            Route::get('/receive-transmittal/{id}', [QAQCRecieverController::class, 'receive'])->name("qaqcreceiver.receive");
            Route::post('/receiveTransmittal', [QAQCRecieverController::class, 'receiveTransmittal'])->name("qaqcreceiver.receiveTransmittal");
            Route::get('/edit-transmittal/{id}', [QAQCRecieverController::class, 'edit'])->name("qaqcreceiver.edit");
            // Route::post('/update', [DeptOfficerController::class, 'update'])->name("deptofficer.update");
    }); 

    // Role Controller
    Route::group(
        ['prefix' => 'roles'],
        function () {
            Route::get('/create', [RoleController::class, 'create'])->name("roles.create");
            Route::get('/getRoles', [RoleController::class, 'getRoles'])->name("roles.getRoles");
            Route::post('/store', [RoleController::class, 'store'])->name("roles.store");
            Route::get('/list', [RoleController::class, 'index'])->name("roles.index");
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name("roles.edit");
            Route::post('/update', [RoleController::class, 'update'])->name("roles.update");
            Route::get('/rolesList', [RoleController::class, 'rolesList'])->name("roles.list");
            Route::get('/rolesList_selected', [RoleController::class, 'rolesList_selected'])->name("roles.list_selected");
        }
    );
     // Permission Controller
     Route::group(
        ['prefix' => 'permissions'],
        function () {
            Route::get('/create', [PermissionController::class, 'create'])->name("permissions.create");
            Route::get('/getPermissions', [PermissionController::class, 'getPermissions'])->name("permissions.getPermissions");
            Route::post('/store', [PermissionController::class, 'store'])->name("permissions.store");
            Route::get('/list', [PermissionController::class, 'index'])->name("permissions.index");
            Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name("permissions.edit");
            Route::post('/update', [PermissionController::class, 'update'])->name("permissions.update");
            Route::get('/modulesList', [PermissionController::class, 'modulesList'])->name("permissions.list");
            Route::get('/getPermission_selected', [PermissionController::class, 'getPermission_selected'])->name("permissions.getPermission_selected");
        }
    );


});
