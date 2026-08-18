<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\NewPasswordController;

use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\MenuItemController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\AdminOrderController;
use App\Http\Controllers\Web\AdminMenuItemController;

use App\Http\Controllers\Web\PaymentController;


/*
|--------------------------------------------------------------------------
| Public Customer-Facing Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'web',
    \App\Http\Middleware\SetLocale::class,
])->group(function () {

    Route::get('/', [MenuItemController::class, 'index'])
        ->name('menu.index');

    Route::get('/checkout', [MenuItemController::class, 'checkout'])
        ->name('checkout.index');

    // Route::post('/order/submit', [OrderController::class, 'store'])
    //     ->name('order.submit');

    Route::get('/lang/{locale}', function ($locale) {

        if (in_array($locale, ['en', 'km'])) {
            session(['locale' => $locale]);
        }

        return redirect()->back();

    })->name('lang.switch');

});


/*
|--------------------------------------------------------------------------
| Password Reset Routes
|--------------------------------------------------------------------------
*/

Route::post('/forgot-password', function (Request $request) {

    $request->validate([
        'email' => ['required', 'email'],
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors([
            'email' => __($status)
        ]);

})->middleware('guest')->name('password.email');


Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Customer'])->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::get('/payment', [PaymentController::class, 'index'])
        ->name('payment.index');

    Route::post('/payment/intent', [PaymentController::class, 'createPaymentIntent'])
        ->name('payment.intent');

    Route::get('/payment/success', [PaymentController::class, 'success'])
        ->name('payment.success');

});

Route::get('/debug-auth', function () {
    $user = auth()->user();

    return response()->json([
        'authenticated' => auth()->check(),
        'user_id' => auth()->id(),
        'role' => $user?->role?->value,
    ]);
})->middleware('auth');

Route::get('/debug-customer', function () {
    return response()->json([
        'success' => true,
        'message' => 'Customer middleware works.',
        'user_id' => auth()->id(),
    ]);
})->middleware(['auth', 'role:Customer']);


/*
|--------------------------------------------------------------------------
| Admin & Staff Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Admin,Staff'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| Admin & Staff Orders
|--------------------------------------------------------------------------
*/

// Route::prefix('admin')
//     ->middleware(['auth', 'role:Admin,Staff'])
//     ->name('admin.')
//     ->group(function () {

       
//     });


/*
|--------------------------------------------------------------------------
| Admin Only Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role:Admin'])
    ->name('admin.')
    ->group(function () {

        Route::resource('category', CategoryController::class);

        Route::resource('menu-items', AdminMenuItemController::class);

        Route::resource('users', UserController::class);

        Route::resource('orders', AdminOrderController::class)
            ->only([
                'index',
                'show',
                'update',
            ]);
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');

});

Route::prefix('staff')
    ->middleware(['auth', 'role:Staff'])
    ->name('staff.')
    ->group(function () {

        Route::resource('orders', AdminOrderController::class)
            ->only([
                'index',
                'show',
                'update',
            ]);
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');

});
