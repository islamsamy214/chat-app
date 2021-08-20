<?php

use App\Http\Controllers\ChatController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    //dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    //chat
    Route::get('/chat', function () {
        return Inertia::render('Chat/Container');
    })->name('chat');

    //rooms
    Route::get('/chat/rooms', [ChatController::class, 'rooms'])->name('rooms');

    //messages
    Route::get('/chat/room/{room_id}/messages', [ChatController::class, 'messages'])->name('messages');
    Route::post('/chat/room/{room_id}/messages', [ChatController::class, 'newMessage'])->name('messages');
});

require __DIR__ . '/auth.php';
