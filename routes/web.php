<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentEquipmentController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentTypeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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

Route::get('/', [DashboardController::class, 'index']);

Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth/login', [AuthController::class, 'doLogin'])->name('doLogin');

Route::get('/equipments/export', [EquipmentController::class, 'export'])->name('equipments.export');

/*Route::resources([
	'employees' => EmployeesController::class,
	'departments' => DepartmentController::class,
	'departments.equipment' => DepartmentEquipmentController::class,
	'equipments' => EquipmentController::class,
	'types' => EquipmentTypeController::class,
	'suppliers' => SupplierController::class,
]);*/

Route::group(['middleware' => ['role:super-admin']], function () {
	
	Route::put('menus/{menu}/submenus/toggle', [SubmenuController::class, 'toggle'])->name('menus.submenus.toggle');
	Route::get('menus/{menu}/submenus/{submenu}/up', [SubmenuController::class, 'orderUp'])->name('menus.submenus.order.up');
	Route::get('menus/{menu}/submenus/{submenu}/down', [SubmenuController::class, 'orderDown'])->name('menus.submenus.order.down');

	Route::put('menus/toggle', [MenuController::class, 'toggle'])->name('menus.toggle');
	Route::get('menus/{menu}/up', [MenuController::class, 'orderUp'])->name('menus.order.up');
	Route::get('menus/{menu}/down', [MenuController::class, 'orderDown'])->name('menus.order.down');


    Route::resources([
    	'users' => UserController::class,
		'roles' => RoleController::class,
	    'permissions' => PermissionController::class,
	    'menus' => MenuController::class,
	    'menus.submenus' => SubmenuController::class
	]);

});

Route::group(['middleware' => ['can:manage-employee']], function () {
	Route::resource('employees', EmployeesController::class);
});

Route::group(['middleware' => ['can:manage-department']], function () {
	Route::resources([
		'departments' => DepartmentController::class,
		'departments.equipment' => DepartmentEquipmentController::class,
	]);
});

Route::group(['middleware' => ['can:manage-equipment']], function () {
	Route::resources([
		'equipments' => EquipmentController::class,
		'types' => EquipmentTypeController::class,
	]);
});

Route::group(['middleware' => ['can:manage-supplier']], function () {
	Route::resource('suppliers', SupplierController::class);
});

Route::get('departments/{department}/delete', [DepartmentController::class, 'delete'])->name('departments.delete');

Route::get('/employees/{employee}/delete', [EmployeesController::class, 'delete'])->name('employees.delete');

Route::get('/departments/{department}/equipment/{equipment}/delete', [DepartmentEquipmentController::class, 'destroy'])->name('departments.equipment.delete');
