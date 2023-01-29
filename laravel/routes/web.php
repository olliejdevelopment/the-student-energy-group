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
        Route::get("/admin/meter/add", "App\Http\Controllers\AdminController@newMeter")->name("meter.add");
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



