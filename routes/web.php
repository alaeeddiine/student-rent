<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'showAll'])->name('properties.index');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// booking routes
Route::middleware(['auth'])->group(function () {
    Route::get('/student/bookings', [BookingController::class, 'studentIndex'])->name('student.bookings');
    Route::delete('/student/bookings/{id}', [BookingController::class, 'destroy'])->name('student.bookings.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/owner/bookings', [BookingController::class, 'ownerIndex'])->name('owner.bookings');
    Route::patch('/owner/bookings/{id}/accept', [BookingController::class, 'accept'])->name('owner.bookings.accept');
    Route::patch('/owner/bookings/{id}/refuse', [BookingController::class, 'refuse'])->name('owner.bookings.refuse');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login'])->name('login.submit'); 
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit'); 
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Dashboards
Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');


// Owner Property Management
Route::get('/owner/properties', [PropertyController::class, 'myProperties'])->name('owner.properties.index');
Route::get('/owner/properties/create', [PropertyController::class, 'create'])->name('owner.properties.create');
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');


Route::get('/owner/my-properties', [PropertyController::class, 'myProperties'])->name('owner.my-properties');
Route::get('/owner/properties/{id}/edit', [PropertyController::class, 'edit'])->name('owner.properties.edit');
Route::put('/owner/properties/{id}', [PropertyController::class, 'update'])->name('owner.properties.update');
Route::delete('/owner/properties/{id}', [PropertyController::class, 'destroy'])->name('owner.properties.destroy');

// Other Routes
Route::get('/owner/messages', fn() => 'Messages Page')->name('owner.messages');
Route::get('/student/rentals', fn() => 'Student Rentals Page')->name('student.rentals');
Route::get('/contact/owners', fn() => 'Contact Owners Page')->name('contact.owners');
