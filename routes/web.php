<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\CustomizeController as AdminCustomizeController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\OverviewController as AdminOverviewController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Store\AccountController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\CheckoutController;
use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\ProductController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

// store routes
Route::get('/', [HomeController::class, 'index'])
    ->name('index');

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products');
    Route::get('/{slug}', [ProductController::class, 'show'])
        ->name('products.show');
});

Route::prefix('/cart')->group(function () {

    Route::get('/', [CartController::class, 'index'])
        ->name('cart');
    Route::post('/', [CartController::class, 'store'])
        ->name('cart.store');

    Route::patch('/', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/{id}', [CartController::class, 'destroy'])
        ->name('cart.destroy');
});

Route::prefix('/checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])
        ->name('checkout')
        ->middleware(['auth']);
    Route::post('/', [CheckoutController::class, 'store'])
        ->name('checkout.store')
        ->middleware(['auth']);
    Route::post('/coupon', [CheckoutController::class, 'coupon'])
        ->name('checkout.coupon')
        ->middleware(['auth']);

    Route::post('/sslcommerz/success', [CheckoutController::class, 'success'])
        ->name('checkout.sslcommerz.success');
    Route::post('/sslcommerz/failure', [CheckoutController::class, 'failure'])
        ->name('checkout.sslcommerz.failure');
    Route::post('/sslcommerz/cancel', [CheckoutController::class, 'cancel'])
        ->name('checkout.sslcommerz.cancel');
    Route::post('/sslcommerz/ipn', [CheckoutController::class, 'ipn'])
        ->name('checkout.sslcommerz.ipn');
});

Route::prefix('/account')->middleware(['auth'])->group(function () {
    Route::get('/', [AccountController::class, 'index'])
        ->name('account');

    Route::get('/orders', [AccountController::class, 'orders'])
        ->name('account.orders');
    Route::get('/orders/{order}', [AccountController::class, 'ordersShow'])
        ->name('account.orders.show');
    Route::get('/orders/{order}/invoice', [AccountController::class, 'ordersInvoice'])
        ->name('account.orders.invoice');

    Route::get('/addresses', [AccountController::class, 'addresses'])
        ->name('account.addresses');
    Route::get('/addresses/billing', [AccountController::class, 'addressesBillingEdit'])
        ->name('account.addresses.billing.edit');
    Route::patch('/addresses/billing', [AccountController::class, 'addressesBillingUpdate'])
        ->name('account.addresses.billing.update');
    Route::get('/addresses/shipping', [AccountController::class, 'addressesShippingEdit'])
        ->name('account.addresses.shipping.edit');
    Route::patch('/addresses/shipping', [AccountController::class, 'addressesShippingUpdate'])
        ->name('account.addresses.shipping.update');

    Route::get('/details', [AccountController::class, 'details'])
        ->name('account.details');
    Route::patch('/details', [AccountController::class, 'detailsUpdate'])
        ->name('account.details.update');
});

// admin routes
Route::prefix('/admin')->middleware(['auth', 'verified', Admin::class])->group(function () {
    Route::get('/', [AdminOverviewController::class, 'index'])
        ->name('admin');
    Route::get('/overview/sales', [AdminOverviewController::class, 'sales'])
        ->name('admin.overview.sales');

    Route::prefix('/users')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])
            ->name('admin.users');
        Route::get('/{user}', [AdminUserController::class, 'show'])
            ->name('admin.users.show');

        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])
            ->name('admin.users.edit');
        Route::patch('/{user}', [AdminUserController::class, 'update'])
            ->name('admin.users.update');

        Route::delete('/{user}', [AdminUserController::class, 'destroy'])
            ->name('admin.users.destroy');
    });

    Route::prefix('/categories')->group(function () {
        Route::get('/create', [AdminCategoryController::class, 'create'])
            ->name('admin.categories.create');
        Route::post('/', [AdminCategoryController::class, 'store'])
            ->name('admin.categories.store');

        Route::get('/', [AdminCategoryController::class, 'index'])
            ->name('admin.categories');
        Route::get('/{category}/sub-categories', [AdminCategoryController::class, 'subCategories'])
            ->name('admin.categories.sub-categories');
        Route::get('/{category}', [AdminCategoryController::class, 'show'])
            ->name('admin.categories.show');

        Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])
            ->name('admin.categories.edit');
        Route::patch('/{category}', [AdminCategoryController::class, 'update'])
            ->name('admin.categories.update');

        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])
            ->name('admin.categories.destroy');
    });

    Route::prefix('/products')->group(function () {
        Route::get('/create', [AdminProductController::class, 'create'])
            ->name('admin.products.create');
        Route::post('/', [AdminProductController::class, 'store'])
            ->name('admin.products.store');

        Route::get('/', [AdminProductController::class, 'index'])
            ->name('admin.products');
        Route::get('/{product}', [AdminProductController::class, 'show'])
            ->name('admin.products.show');

        Route::get('/{product}/edit', [AdminProductController::class, 'edit'])
            ->name('admin.products.edit');
        Route::patch('/{product}', [AdminProductController::class, 'update'])
            ->name('admin.products.update');

        Route::delete('/{product}', [AdminProductController::class, 'destroy'])
            ->name('admin.products.destroy');
    });

    Route::prefix('coupons')->group(function () {
        Route::get('/create', [AdminCouponController::class, 'create'])
            ->name('admin.coupons.create');
        Route::post('/', [AdminCouponController::class, 'store'])
            ->name('admin.coupons.store');

        Route::get('/', [AdminCouponController::class, 'index'])
            ->name('admin.coupons');
        Route::get('/{coupon}', [AdminCouponController::class, 'show'])
            ->name('admin.coupons.show');

        Route::get('/{coupon}/edit', [AdminCouponController::class, 'edit'])
            ->name('admin.coupons.edit');
        Route::patch('/{coupon}', [AdminCouponController::class, 'update'])
            ->name('admin.coupons.update');

        Route::delete('/{coupon}', [AdminCouponController::class, 'destroy'])
            ->name('admin.coupons.destroy');
    });

    Route::prefix('/orders')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])
            ->name('admin.orders');
        Route::get('/{order}', [AdminOrderController::class, 'show'])
            ->name('admin.orders.show');

        Route::patch('/{order}', [AdminOrderController::class, 'update'])
            ->name('admin.orders.update');

        Route::delete('/{order}', [AdminOrderController::class, 'destroy'])
            ->name('admin.orders.destroy');
    });

    Route::prefix('/settings')->group(function () {
        Route::get('/', [AdminSettingController::class, 'index'])
            ->name('admin.settings');

        Route::get('/delivery-charge', [AdminSettingController::class, 'deliveryCharge'])
            ->name('admin.settings.delivery-charge');
        Route::post('/delivery-charge', [AdminSettingController::class, 'deliveryChargeStore'])
            ->name('admin.settings.delivery-charge.store');
        Route::patch('/delivery-charge', [AdminSettingController::class, 'deliveryChargeUpdate'])
            ->name('admin.settings.delivery-charge.update');

        Route::get('/customize', [AdminCustomizeController::class, 'index'])
            ->name('admin.settings.customize');
        Route::patch('/customize/news-flashes', [AdminCustomizeController::class, 'updateNewsFlashes'])
            ->name('admin.settings.customize.news-flashes.update');
        Route::patch('/customize/hero-sliders', [AdminCustomizeController::class, 'updateHeroSliders'])
            ->name('admin.settings.customize.hero-sliders.update');
    });

});

// auth routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// todo

Route::middleware([])->group(function () {
    Route::get('/about', fn () => view('store/about'))->name('about');
    Route::get('/contact', fn () => view('store/contact'));
    Route::get('/store-login', fn () => view('store/login'));
    Route::get('/store-register', fn () => view('store/register'));
    Route::get('/store-forgot-password', fn () => view('store/forgot-password'));
    Route::get('/store-reset-password', fn () => view('store/reset-password'));
    Route::get('/purchase-guide', fn () => view('store/purchase-guide'));
    Route::get('/privacy-policy', fn () => view('store/privacy-policy'));
    Route::get('/terms', fn () => view('store/terms'));
    Route::get('/404', fn () => view('store/404'));
});
