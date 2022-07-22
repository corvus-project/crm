<?php

use App\Http\Controllers\OtherBrowserSessionsController;
use App\Http\Controllers\TokenAuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('guest')->group(
    function () {
        $limiter = config('fortify.limiters.login');

        Route::post('/auth/token', [TokenAuthController::class, 'store'])->middleware(
            array_filter([$limiter ? 'throttle:' . $limiter : null])
        );
    }
);

Route::post('/orders/create', [OrderController::class, 'upload_csv']);

Route::middleware('auth:sanctum')->group(
    function () {
        Route::delete('/auth/token', [TokenAuthController::class, 'destroy']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::get('/me', [UserController::class, 'me']);
        Route::get('/user/sessions', [OtherBrowserSessionsController::class, 'index']);
        Route::post('/user/sessions/purge', [OtherBrowserSessionsController::class, 'destroy']);

        Route::get('/tickets', [TicketController::class, 'index']);
        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/{product}/show', [ProductController::class, 'show']);

        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{order}/show', [OrderController::class, 'show']);
        Route::post('/orders', [OrderController::class, 'store']);

    }
);
