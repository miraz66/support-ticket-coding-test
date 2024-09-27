<?php

use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [TicketController::class, 'index'])->name('customer.tickets');

// Customer Routes
Route::middleware('auth')->group(function () {
    Route::get('/customer/create', [TicketController::class, 'create'])->name('customer.create');
    Route::get('/customer/{ticket}', [TicketController::class, 'show'])->name('customer.show');
    Route::post('/customer/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::post('/customer/{ticket}/reply', [TicketController::class, 'customerReply'])->name('customer.reply');
});

// Admin Routes
Route::middleware(['auth', 'role:admin', 'verified'])->group(function () {
    Route::get('/admin', [AdminTicketController::class, 'index'])->name('admin');
    Route::get('/admin/{ticket}', [AdminTicketController::class, 'show'])->name('admin.show');
    Route::post('/admin/{ticket}/close', [AdminTicketController::class, 'close'])->name('admin.close');
    Route::post('/admin/{ticket}/reply', [AdminTicketController::class, 'AdminReply'])->name('admin.reply');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
