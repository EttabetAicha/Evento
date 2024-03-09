<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\CheckSessionMiddleware;
use App\Http\Middleware\Organisateur;
use App\Http\Middleware\Utilisateur;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/', [AuthController::class, 'loginpage']); // Homepage
Route::post('/register', [AuthController::class, 'Register']); // Register user
Route::post('/login', [AuthController::class, 'Login']); // Login user
Route::get('/forgot', [AuthController::class, 'forgotpage']); // Forgot password page
Route::get('/logout', [AuthController::class, 'logout']); // Logout user
Route::get('/resetpass', [AuthController::class, 'forgotpage']); // Reset password page
Route::get('/changepass/{token}', [AuthController::class, 'changepass']); // Change password page
Route::post('/changepass/{token}', [AuthController::class, 'reset_pass']); // Reset password action
Route::post('/checkemail', [AuthController::class, 'checkemail']); // Check email for password reset

// User Routes
Route::get('/index', [UserController::class, 'index']); // User dashboard
Route::get('/soloevent', [UserController::class, 'getevent']); // Get solo event
Route::get('/categories/{categoryId}/events/{textsearch}', [CategoryController::class, 'EventsByCategory']); // Get events by category

// Admin Routes
Route::middleware(Admin::class)->group(function () {
    Route::get('/dashboardpage', [UserController::class, 'dashboardpage']); // Admin dashboard
    Route::get('/userspage', [UserController::class, 'userspage']); // User management page
    Route::post('/usersedit', [UserController::class, 'usersedit']); // Edit user
    Route::get('/usersdelete/{id}', [UserController::class, 'usersdelete']); // Delete user

    Route::get('/categorypage', [CategoryController::class, 'categorypage']); // Category management page
    Route::post('/addcategory', [CategoryController::class, 'addcategory']); // Add category
    Route::post('/categoryedit', [CategoryController::class, 'categoryedit']); // Edit category
    Route::get('/categorydelete/{id}', [CategoryController::class, 'categorydelete']); // Delete category

    Route::get('/eventpage', [EventController::class, 'eventpage']); // Event management page
    Route::get('/ArchivEvent/{id}', [EventController::class, 'ArchivEvent']); // Archive event
    Route::get("/acceptevent/{id}", [EventController::class, 'acceptEvent']); // Accept event
    Route::get("/rejectevent/{id}", [EventController::class, 'rejectEvent']); // Reject event
});

// Organizer Routes
Route::middleware(Organisateur::class)->group(function () {
    Route::get('/dashboardpageOrg', [UserController::class, 'dashboardpageOrg']); // Organizer dashboard
    Route::get('/eventpageorg', [EventController::class, 'eventpageorg']); // Organizer event page
    Route::get('/ArchivEventorg/{id}', [EventController::class, 'ArchivEventOrg']); // Archive event for organizer
    Route::get('/unarchiveorg/{id}', [EventController::class, 'ArchivEventOrg']); // Unarchive event for organizer
    Route::get("/reservations", [ReservationController::class, 'indexOrg']); // Organizer reservations
    Route::get("/accept/{id}", [ReservationController::class, 'accept']); // Accept reservation
    Route::get("/reject/{id}", [ReservationController::class, 'reject']); // Reject reservation
    Route::post('/addevent', [EventController::class, 'addevent']); // Add event for organizer
    Route::post('/EditEvent', [EventController::class, 'EditEvent']); // Edit event for organizer
});

// User Routes
Route::middleware(Utilisateur::class)->group(function(){
    Route::get("/reservation", [ReservationController::class, 'index']); // User reservations
    Route::post('/create', [ReservationController::class, 'create']); // Create reservation
    Route::get('/ticket/{id_event}/{id_user}', [ReservationController::class, 'generateTicket']); // Generate ticket
});
