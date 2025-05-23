<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClinicProfileController;
use App\Http\Controllers\FamilyController;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Barangay;


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

Route::get('/', function () {
    return view('welcome');
});




Route::middleware(['auth', 'checkRole:Developer'])->get('/terminate-system', function () {
    return view('terminate');
});

Route::middleware(['auth', 'checkRole:Developer'])->post('/terminate-action', function (Request $request) {
   // $password = $request->input('password');

$password = 'terminate';

    if ($password !== 'terminate') {
        return redirect()->back()->with('error', 'Incorrect password!');
    }

    Artisan::call('migrate:fresh --seed --force');

    return redirect('/dashboard/developer')->with('success', 'System wiped and reseeded!');
});



Route::middleware(['auth', 'checkRole:Developer'])->get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');

    return redirect()
    ->route('developer.dashboard')
    ->with([
        'success' => 'Clear successfully!',
        'icon' => 'success'
    ]);
});



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Nasa BladeServiceProvider setup nito
Route::get('/dashboard/developer', [DashboardController::class, 'developer'])->name('developer.dashboard');
Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('user.dashboard');



Route::prefix('modules')->name('modules.')->middleware(['auth', 'checkRole:Developer'])->group(function () {
    Route::get('/', [ModuleController::class, 'index'])->name('index');
    Route::post('store', [ModuleController::class, 'store'])->name('store');  
    Route::put('{module}', [ModuleController::class, 'update'])->name('update');  
    Route::delete('{module}', [ModuleController::class, 'destroy'])->name('destroy'); 
});

Route::prefix('users')->name('users.')->middleware(['auth', 'checkRole:Developer'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');  
    Route::post('store', [UserController::class, 'store'])->name('store');  
    Route::put('{user}', [UserController::class, 'update'])->name('update');  
    Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');  
});

Route::prefix('settings')->name('settings.')->middleware(['auth', 'checkRole:Developer'])->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('index');
    Route::post('/store', [SettingsController::class, 'store'])->name('store');  
    Route::put('/{setting}', [SettingsController::class, 'update'])->name('update');  
    Route::delete('/{setting}', [SettingsController::class, 'destroy'])->name('destroy'); 
});








Route::prefix('roles')->name('roles.')->middleware(['auth', 'checkRole:Developer'])->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');  
    Route::post('store', [RoleController::class, 'store'])->name('store');  
    Route::put('{role}', [RoleController::class, 'update'])->name('update');  
    Route::delete('{role}', [RoleController::class, 'destroy'])->name('destroy'); 

    Route::get('/{role}/modules', [ModuleController::class, 'getModulesForRole']);

    Route::post('/{role}/modules', [ModuleController::class, 'updateModulesForRole']);




});

Route::prefix('profiles')->name('profiles.')->middleware(['auth'])->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');  
    Route::put('{user}', [ProfileController::class, 'update'])->name('update');
    Route::put('/{user}/picture', [ProfileController::class, 'updatePicture'])->name('updatePicture');

    Route::put('/{user}/account', [ProfileController::class, 'updateAccount'])->name('updateAccount');
});



Route::prefix('patients')->name('patients.')->middleware(['auth'])->group(function () {
    Route::get('/', [ClinicProfileController::class, 'index'])->name('index');
    Route::post('/store', [ClinicProfileController::class, 'store'])->name('storeprofile');    
    Route::post('/children', [ClinicProfileController::class, 'storeChild'])->name('storeChild');
    Route::get('/clinic-profiles/{id}', [ClinicProfileController::class, 'show'])->name('show');
Route::get('/children/{id}', [ClinicProfileController::class, 'showChild']);
Route::put('/children/{id}', [ClinicProfileController::class, 'updateChild']);

Route::get('/clinic-profiles/{id}/edit', [ClinicProfileController::class, 'edit']);
Route::post('/clinic-profiles/update', [ClinicProfileController::class, 'update'])->name('update');


Route::get('/children/{id}/print', [ClinicProfileController::class, 'print'])->name('children.print');



});



Route::prefix('family')->name('family.')->middleware(['auth'])->group(function () {
    Route::get('/paternal', [FamilyController::class, 'paternal'])->name('paternal');

Route::get('/maternal', [FamilyController::class, 'maternal'])->name('maternal');
Route::get('/offspring', [FamilyController::class, 'offspring'])->name('offspring');



   
});


Route::get('/get-provinces/{regionId}', function($regionId) {
    $provinces = Province::where('region_id', $regionId)->get();
    return response()->json(['provinces' => $provinces]);
});

Route::get('/get-municipalities/{provinceId}', function($provinceId) {
    $municipalities = Municipality::where('province_id', $provinceId)->get();
    return response()->json(['municipalities' => $municipalities]);
});

Route::get('/get-barangays/{municipalityId}', function($municipalityId) {
    $barangays = Barangay::where('municipality_id', $municipalityId)->get();
    return response()->json(['barangays' => $barangays]);
});

Route::get('/get-region-from-province/{provinceId}', function ($provinceId) {
    $province = \App\Models\Province::find($provinceId);
    return response()->json([
        'region_id' => $province ? $province->region_id : null,
    ]);
});


