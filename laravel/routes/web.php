<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Laravel\Jetstream\Rules\Role;
use Spatie\Permission\Models\Role;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(["middleware" => ["role:admin"]], function () {
        
        Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin');

        Route::get('/admin/meter', 'App\Http\Controllers\AdminController@meterIndex')->name('admin.meter.index');
        Route::get("/admin/meter/add", "App\Http\Controllers\AdminController@newMeter")->name("admin.meter.add");
        Route::get("/admin/meter/{id}/view", "App\Http\Controllers\AdminController@meterView")->name("admin.meter.view");
        Route::get('/admin/meter/{id}/reading/add', 'App\Http\Controllers\AdminController@newMeterReading')->name('admin.meter.custom.reading.add');
        Route::get('/admin/meter/reading/add', 'App\Http\Controllers\AdminController@newMeterReading')->name('admin.meter.reading.add');
        
        Route::get("/admin/customer/{id}/view", "App\Http\Controllers\AdminController@customerView")->name("admin.customer.view");
        Route::get("/admin/customers", "App\Http\Controllers\AdminController@customerIndex")->name("admin.customer.index");

    });

    // Remove this code for production
    Route::get('/addrole/{role}', function ($role) {
        
        if (!Role::where("name", $role)->exists()) {
            Role::create(["name" => $role, "guard_name" => "web"]);
            echo "Role created";
        }
        else{
            echo "Role already exists";
        }

        $user = Auth::user();
        // assign role by name  
        $user->assignRole(['name' => $role]);
    
        return redirect()->back();

    })->name('addrole');


});



