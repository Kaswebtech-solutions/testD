<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DataManagementController;
use App\Http\Controllers\admin\AssignRoleController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\admin\UserRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [AdminController::class, 'Login'])->middleware(["CustomAuthCheck"]);
Route::post('/login', [AdminController::class, 'Login'])->middleware(["CustomAuthCheck"]);
Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['prefix' => 'AuthCheck'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AdminController::class, 'Logout']);
        //******************************************Admin Profile*********************************************//
        Route::get('/profile', [AdminController::class, 'adminProfile']);
        Route::post('/profile/changePassword', [AdminController::class, 'changePassword'])->name('users-change-password');
        Route::post('/profile/changeProfileImage', [AdminController::class, 'changeProfileImage'])->name('users-change-image');
        Route::post('/update/info', [AdminController::class, 'updateInfo'])->name('admin.info.update');
        //******************************************User*********************************************//
        Route::get('/user', [UserRegisterController::class, 'viewUser'])->name('view-user');
        Route::post('/user/adduser', [UserRegisterController::class, 'addUser'])->name('user.add');
        Route::post('/user/togglestatus', [UserRegisterController::class, 'ToggleUserStatus'])->name('user.update.status');
        Route::get('/user/viewdata/{id}', [UserRegisterController::class, 'viewData'])->name('user.viewData');
        Route::get('/user/updateuser', [UserRegisterController::class, 'UpdateUser'])->name('user.updateuser');
        Route::post('/user/updateuserdata', [UserRegisterController::class, 'UpdateUserData'])->name('user.updateuserdata');
        Route::get('/user/search', [UserRegisterController::class, 'filter'])->name('user.search');
        Route::get('/user/remove', [UserRegisterController::class, 'UserRemove'])->name('user.remove');
        Route::post('forget-password', [UserRegisterController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
        Route::get('reset-password/{token}/{email}', [UserRegisterController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [UserRegisterController::class, 'submitResetPasswordForm'])->name('reset.password.post'); 
        //******************************************Data management*********************************************//
        Route::get('/data', [DataManagementController::class,'dataView'])->name('data.view');
        Route::get('/data/search', [DataManagementController::class, 'filterData'])->name('data.search');    
        Route::get('/data/update/view', [DataManagementController::class, 'dataEditView'])->name('data.edit');
        Route::post('/data/update/data', [DataManagementController::class, 'dataUpdate'])->name('data.update');
        Route::get('/data/viewdata/{id}', [DataManagementController::class, 'viewData'])->name('data.viewData');
        Route::get('/data/sync/', [DataManagementController::class, 'dataSync'])->name('data.sync');
        //******************************************Permission*********************************************//
        Route::get('/permissions', [PermissionController::class,'permissionView'])->name('permission.view');
        Route::post('/permission/add', [PermissionController::class, 'addPermission'])->name('permission.add');
        Route::get('/permission/update/view', [PermissionController::class, 'permissionEditView'])->name('permission.edit');
        Route::post('/permission/update/data', [PermissionController::class, 'permissionUpdate'])->name('permission.update');
        Route::get('/permission/search', [PermissionController::class, 'filterPermission'])->name('permission.search');
        Route::get('/permission/remove', [PermissionController::class, 'permissionRemove'])->name('permission.remove');

        //******************************************Role*********************************************//
        Route::get('/roles', [RoleController::class,'rolesView'])->name('roles.view');
        Route::post('/roles/add', [RoleController::class, 'addroles'])->name('roles.add');
        Route::get('/roles/update/view', [RoleController::class, 'rolesEditView'])->name('roles.edit');
        Route::post('/roles/update/data', [RoleController::class, 'rolesUpdate'])->name('roles.update');
        Route::get('/role/remove', [RoleController::class, 'roleRemove'])->name('role.remove');

        //******************************************Role Has Permission*********************************************//
        Route::get('/rolespermission', [RolePermissionController::class,'rolesPermissionView'])->name('roles.Permission.view');
        Route::get('/rolesp/update/view', [RolePermissionController::class, 'rolesPEditView'])->name('roles.p.edit');
        Route::post('/rolesp/update/data', [RolePermissionController::class, 'rolesPUpdate'])->name('roles.p.update');
        //******************************************Assign Role*********************************************//
        Route::get('/assignrolesview', [AssignRoleController::class,'assignRolesView'])->name('assign.roles.view');
        Route::get('/assign/roles/update/view', [AssignRoleController::class, 'assignRolesEditView'])->name('assign.roles.update.view');
                Route::post('/assign/roles/update', [AssignRoleController::class, 'assignRolesUpdate'])->name('assign.roles.update');
        Route::get('/assignpermission/search', [AssignRoleController::class, 'filterAssignPermission'])->name('assign.permission.search');

    });
});
