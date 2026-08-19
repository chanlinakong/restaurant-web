<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\AdminMenuItemController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminOrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\Api\AddressController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Menu items available to customers
Route::get('/menu-items', [MenuItemController::class, 'index']);



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Categories
//Route::get('/categories', [CategoryController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    // Route::get('/me', [AuthController::class, 'me']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/orders', [OrderController::class, 'store']);

     Route::get('/me', [
        ProfileController::class,
        'show',
    ]);

    Route::put('/user/profile', [
        ProfileController::class,
        'update',
    ]);

    Route::post('/user/profile-image', [
        ProfileController::class,
        'updateImage',
    ]);

    Route::put('/user/password', [
        ProfileController::class,
        'updatePassword',
    ]);
});


/*
|--------------------------------------------------------------------------
| Customer API Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'role:Customer'])->group(function () {

    // Orders
    Route::get('/orders', [OrderController::class, 'index']);


    Route::get('/orders/{order}', [OrderController::class, 'show']);

     Route::get('/addresses', [AddressController::class, 'index']);

    Route::post('/addresses', [AddressController::class, 'store']);

    Route::get('/addresses/{address}', [AddressController::class, 'show']);

    Route::put('/addresses/{address}', [AddressController::class, 'update']);

    Route::delete('/addresses/{address}', [AddressController::class, 'destroy']);

    Route::put(
        '/addresses/{address}/default',
        [AddressController::class, 'setDefault']
    );

    // Payment
    // Add your API PaymentController here later
});


/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'role:Admin'])
    ->group(function () {

        /*
        | Categories
        */
        Route::apiResource('categories', CategoryController::class);


        /*
        | Menu Items
        */
        Route::apiResource('menu-items', AdminMenuItemController::class);


        /*
        | Users
        */
        Route::apiResource('users', UserController::class);


        /*
        | Orders
        */
        Route::get('/orders', [AdminOrderController::class, 'index']);

        Route::get('/orders/{order}', [AdminOrderController::class, 'show']);

        Route::patch('/orders/{order}', [AdminOrderController::class, 'update']);
    });


/*
|--------------------------------------------------------------------------
| Staff API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('staff')
    ->middleware(['auth:sanctum', 'role:Staff'])
    ->group(function () {

        /*
        | Orders
        */
        Route::get('/orders', [AdminOrderController::class, 'index']);

        Route::get('/orders/{order}', [AdminOrderController::class, 'show']);

        Route::patch('/orders/{order}', [AdminOrderController::class, 'update']);
    }); 

Route::post('/payment/create-intent', [PaymentController::class, 
'createPaymentIntent']);

