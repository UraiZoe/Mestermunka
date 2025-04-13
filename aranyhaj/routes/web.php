<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;



/* Authentication */
Route::get('/registration', [AuthController::class, 'register'])->name('register');
Route::post('/registration', [AuthController::class, 'registerPost'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');


/* Home */
Route::get('/', [HomeController::class, 'index']);

/* Events */
Route::get('/events', [EventController::class, 'showEventsDatas']);
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Like és participate műveletek
Route::post('/event/like', [InteractionController::class, 'likeEvent'])->name('event.like')->middleware('auth');
Route::post('/event/participate', [InteractionController::class, 'participateEvent'])->name('event.participate')->middleware('auth');

Route::get('/participates', [InteractionController::class, 'userParticipates'])->name('user.participates');

/* Salons */
Route::get('/salons', [SalonController::class, 'index'])->name('salons.index');
Route::get('/salons/all', [SalonController::class, 'listAllSalons'])->name('salons.listAll');
Route::get('/salons/data', [SalonController::class, 'showSalonsDatas'])->name('salons.data');

Route::get('/salons/{id}', [SalonController::class, 'show'])->name('salons.show');

/* Interaction (Require Auth) */
Route::middleware('auth')->group(function () {
    Route::post('/like-event', [InteractionController::class, 'likeEvent']);
    Route::post('/participate-event', [InteractionController::class, 'participateEvent']);
});

/* Profile (Require Auth) */
Route::middleware('auth')->group(function () {
    Route::post('/profile/updateUrl', [ProfileController::class, 'profileImageUpdate'])->name('profile.updateUrl');
    Route::post('/profile/updateEmail', [ProfileController::class, 'emailUpdate'])->name('email.change');
    Route::post('/profile/updatePassword', [ProfileController::class, 'changePassword'])->name('password.change');
    Route::post('/profile/updateAddress', [ProfileController::class, 'changeAddress'])->name('address.change');
});
/* Static Pages */
Route::view('/user', 'user'); // user.blade.php
Route::view('/donate', 'donate'); // donate.blade.php
Route::view('/about', 'about'); // about.blade.php
Route::view('/help', 'help'); // help.blade.php
Route::view('/adminEvent', 'adminEvent'); // adminEvent.blade.php
Route::view('/adminSalon', 'adminSalon'); // adminSalon.blade.php

//admin felület
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::post('/admin/make-admin/{id}', [AdminController::class, 'makeAdmin'])->name('admin.makeAdmin');
    Route::post('/admin/remove-admin/{id}', [AdminController::class, 'removeAdmin'])->name('admin.removeAdmin');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

    Route::get('/admin/create-salon', [AdminController::class, 'createSalonForm'])->name('admin.createSalonForm');
    Route::post('/admin/create-salon', [AdminController::class, 'createSalon'])->name('admin.createSalon');
    Route::get('/admin/edit-salon/{salon}', [AdminController::class, 'editSalon'])->name('admin.editSalon');
    Route::put('/admin/update-salon/{salon}', [AdminController::class, 'updateSalon'])->name('admin.updateSalon');
    Route::delete('/admin/delete-salon/{salon}', [AdminController::class, 'deleteSalon'])->name('admin.deleteSalon');

    Route::get('/admin/create-event', [AdminController::class, 'createEventPage'])->name('admin.createEventForm');
    Route::post('/admin/create-event', [AdminController::class, 'createEvent'])->name('admin.createEvent');
    Route::get('/admin/edit-event/{id}', [AdminController::class, 'editEvent'])->name('admin.editEvent');
    Route::get('/admin/event-details/{id}', [AdminController::class, 'showEventDetails'])->name('admin.eventDetails');
    Route::put('/admin/update-event/{id}', [AdminController::class, 'updateEvent'])->name('admin.updateEvent');
    Route::delete('/admin/delete-event/{id}', [AdminController::class, 'deleteEvent'])->name('admin.deleteEvent');
});

//szalontulajdonos felület
Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/owner', [OwnerController::class, 'index'])->name('owner.dashboard');
    Route::get('/owner/create-event', [OwnerController::class, 'createEventPage'])->name('owner.createEven');
    Route::post('/owner/create-event', [OwnerController::class, 'createEvent'])->name('owner.createEvent');

    Route::get('/owner/edit-salon/{salon}', [OwnerController::class, 'editSalon'])->name('owner.editSalon');
    Route::put('/owner/update-salon/{salon}', [OwnerController::class, 'updateSalon'])->name('owner.updateSalon');    

    Route::get('/owner/event-details/{id}', [EventController::class, 'showEventDetails'])->name('owner.eventDetails');

    Route::get('/owner/edit-event/{id}', [OwnerController::class, 'editEvent'])->name('owner.editEvent');
    Route::put('/owner/update-event/{id}', [OwnerController::class, 'updateEvent'])->name('owner.updateEvent');
    Route::delete('/owner/delete-event/{id}', [OwnerController::class, 'deleteEvent'])->name('owner.deleteEvent');
});