<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

require_once 'theme-routes.php';
Auth::routes();

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

        Route::resource('/coti', App\Http\Controllers\CotizacionController::class);
        Route::resource('/item', App\Http\Controllers\ItemController::class);

        Route::resource('/code', App\Http\Controllers\CodeController::class);

        Route::get('/config/person/export', [App\Http\Controllers\PersonController::class, 'export'])->name("person.export");
        Route::get('/config/person/modal', [App\Http\Controllers\PersonController::class, 'modal'])->name("person.modal");
        Route::post("/config/person/activate", [App\Http\Controllers\PersonController::class, 'activate'])->name("person.activate");
        Route::resource('/config/person', App\Http\Controllers\PersonController::class);

        Route::get('/config/intermediary/export', [App\Http\Controllers\IntermediaryController::class, 'export'])->name("intermediary.export");
        Route::get('/config/intermediary/{code}', [App\Http\Controllers\IntermediaryController::class, 'index'])->name("intermediary.index");
        Route::post("/config/intermediary/activate", [App\Http\Controllers\IntermediaryController::class, 'activate'])->name("intermediary.activate");
        Route::resource('/config/intermediary', App\Http\Controllers\IntermediaryController::class);

        Route::get('/config/type/export', [App\Http\Controllers\TypeController::class, 'export'])->name("type.export");
        Route::post("/config/type/activate", [App\Http\Controllers\TypeController::class, 'activate'])->name("type.activate");
        Route::resource('/config/type', App\Http\Controllers\TypeController::class);

        Route::get('/config/company/export', [App\Http\Controllers\CompanyController::class, 'export'])->name("company.export");
        Route::post("/config/company/activate", [App\Http\Controllers\CompanyController::class, 'activate'])->name("company.activate");
        Route::resource('/config/company', App\Http\Controllers\CompanyController::class);

        Route::get('/config/ramo/export', [App\Http\Controllers\RamoController::class, 'export'])->name("ramo.export");
        Route::post("/config/ramo/activate", [App\Http\Controllers\RamoController::class, 'activate'])->name("ramo.activate");
        Route::resource('/config/ramo', App\Http\Controllers\RamoController::class);

        Route::get('/config/cobertura/export', [App\Http\Controllers\CoberturaController::class, 'export'])->name("cobertura.export");
        Route::post("/config/cobertura/activate", [App\Http\Controllers\CoberturaController::class, 'activate'])->name("cobertura.activate");
        Route::resource('/config/cobertura', App\Http\Controllers\CoberturaController::class);

        Route::get('/config/coin/export', [App\Http\Controllers\CoinController::class, 'export'])->name("coin.export");
        Route::post("/config/coin/activate", [App\Http\Controllers\CoinController::class, 'activate'])->name("coin.activate");
        Route::resource('/config/coin', App\Http\Controllers\CoinController::class);

        Route::get('/access/role/export', [App\Http\Controllers\RoleController::class, 'export'])->name("role.export");
        Route::post('/access/role/givePermission', [App\Http\Controllers\RoleController::class, 'givePermission'])->name("role.givePermission");
        Route::post('/access/role/revokePermission', [App\Http\Controllers\RoleController::class, 'revokePermission'])->name("role.revokePermission");
        Route::post("/access/role/activate", [App\Http\Controllers\RoleController::class, 'activate'])->name("role.activate");
        Route::resource('/access/role', App\Http\Controllers\RoleController::class);

        Route::get('/config/region/export', [App\Http\Controllers\RegionController::class, 'export'])->name("region.export");
        Route::post("/config/region/activate", [App\Http\Controllers\RegionController::class, 'activate'])->name("region.activate");
        Route::resource('/config/region', App\Http\Controllers\RegionController::class);

        Route::get('/config/city/export', [App\Http\Controllers\CityController::class, 'export'])->name("city.export");
        Route::post("/config/city/activate", [App\Http\Controllers\CityController::class, 'activate'])->name("city.activate");
        Route::resource('/config/city', App\Http\Controllers\CityController::class);

        Route::get('/config/commune/export', [App\Http\Controllers\CommuneController::class, 'export'])->name("commune.export");
        Route::post("/config/commune/activate", [App\Http\Controllers\CommuneController::class, 'activate'])->name("commune.activate");
        Route::resource('/config/commune', App\Http\Controllers\CommuneController::class);

        Route::get('/config/color/export', [App\Http\Controllers\ColorController::class, 'export'])->name("color.export");
        Route::post("/config/color/activate", [App\Http\Controllers\ColorController::class, 'activate'])->name("color.activate");
        Route::resource('/config/color', App\Http\Controllers\ColorController::class);

        Route::get('/config/typevehicle/export', [App\Http\Controllers\TypeVehicleController::class, 'export'])->name("typevehicle.export");
        Route::post("/config/typevehicle/activate", [App\Http\Controllers\TypeVehicleController::class, 'activate'])->name("typevehicle.activate");
        Route::resource('/config/typevehicle', App\Http\Controllers\TypeVehicleController::class);

        Route::get('/config/usevehicle/export', [App\Http\Controllers\UseVehicleController::class, 'export'])->name("usevehicle.export");
        Route::post("/config/usevehicle/activate", [App\Http\Controllers\UseVehicleController::class, 'activate'])->name("usevehicle.activate");
        Route::resource('/config/usevehicle', App\Http\Controllers\UseVehicleController::class);

        Route::get('/config/branchvehicle/export', [App\Http\Controllers\BranchVehicleController::class, 'export'])->name("branchvehicle.export");
        Route::post("/config/branchvehicle/activate", [App\Http\Controllers\BranchVehicleController::class, 'activate'])->name("branchvehicle.activate");
        Route::resource('/config/branchvehicle', App\Http\Controllers\BranchVehicleController::class);

        Route::get('/config/modelvehicle/export', [App\Http\Controllers\ModelVehicleController::class, 'export'])->name("modelvehicle.export");
        Route::post("/config/modelvehicle/activate", [App\Http\Controllers\ModelVehicleController::class, 'activate'])->name("modelvehicle.activate");
        Route::resource('/config/modelvehicle', App\Http\Controllers\ModelVehicleController::class);

        Route::get('/config/typenovehicle/export', [App\Http\Controllers\TypeNoVehicleController::class, 'export'])->name("typenovehicle.export");
        Route::post("/config/typenovehicle/activate", [App\Http\Controllers\TypeNoVehicleController::class, 'activate'])->name("typenovehicle.activate");
        Route::resource('/config/typenovehicle', App\Http\Controllers\TypeNoVehicleController::class);

        Route::get('/notification/download', [App\Http\Controllers\NotificationController::class, 'download'])->name("notification.download");
        Route::resource('/notification', App\Http\Controllers\NotificationController::class);

        Route::get('/access/user/export', [App\Http\Controllers\UserController::class, 'export'])->name("user.export");
        Route::post("/access/user/activate", [App\Http\Controllers\UserController::class, 'activate'])->name("user.activate");

        Route::post("/user/upload/{user}", [App\Http\Controllers\UserController::class, 'uploadImage'])->name("user.uploadImage");
        Route::delete("/user/upload/{user}", [App\Http\Controllers\UserController::class, 'deleteImage'])->name("user.deleteImage");

        Route::resource('/access/user', App\Http\Controllers\UserController::class);

        Route::get('/config/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
        Route::post('/config/settings', [App\Http\Controllers\SettingController::class, 'store'])->name('settings.store');

        Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    }


);
