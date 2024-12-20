<?php

use App\Http\Controllers\FarmerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginController;
use App\Models\Farmer;
use Illuminate\Support\Facades\Log;
use lemonpatwari\bangladeshgeocode\Models\Division;

Route::get('/form/{type}', function ($type) {
    
    $viewName = 'partials.' . $type . '_form';

    if (view()->exists($viewName)) {
        $divisions = Division::all();  // Example dynamic data
        $htmlContent = view($viewName, compact('divisions'))->render();
        return response()->json(['html' => $htmlContent]);

        
    }

    return response()->json(['error' => 'Form not found'], 404);
});




    Route::prefix('farmer')
        ->middleware(['authmid:farmer', 'role:Farmer']) // Ensure the user is authenticated and has the "Farmer" role
        ->controller(FarmerController::class)
        ->group(function () {
            Route::get('/mydashboard', 'index')->name('farmer.index');
            Route::get('/edit-my-profile', 'edit')->name('farmer.edit');
            Route::post('/update-profile', 'update')->name('farmer.update');

        });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});







//frontend

Route::controller(HomeController::class) // Specify HomeController
    ->group(function () {
        Route::get('/', 'index')->name('home.index'); 
        Route::get('/about', 'about')->name('home.about'); 
        Route::get('/contact', 'contact')->name('home.contact'); 
        Route::get('/our-hub-points', 'hubpoint')->name('home.hubpoint');
        Route::get('/registration', 'registration')->name('home.registration');
        Route::get('/login-form', 'login')->name('home.login');
    });
    Route::post('/login-submit', [LoginController::class, 'authenticate'])->name('u-login');



        
        Route::post('farmer/registration',[FarmerController::class,'store'] )->name('farmers.store');

    Route::get('/get-districts/{division_id}', [LocationController::class, 'getDistricts']);
    Route::get('/get-thanas/{district_id}', [LocationController::class, 'getThanas']);
    
require __DIR__.'/auth.php';
