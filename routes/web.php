<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as CustomerProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\Customer\PageController;
use App\Http\Controllers\Sales\DashboardController as SalesDashboardController;
use App\Http\Controllers\Admin\SalesController;
use App\Models\Category;


//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $roleName = strtolower((string) $user->role?->name);

    if ($roleName === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($roleName === 'sales') {
        return redirect()->route('sales.dashboard');
    }

    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','admin'])
->prefix('admin')
->group(function(){


    Route::get('/dashboard',
    [DashboardController::class,'index'])
    ->name('admin.dashboard');


    Route::resource(
        'products',
        ProductController::class
    );

    Route::resource(
        'orders',
        OrderController::class
    )
    ->only([
        'index',
        'show',
        'update'
    ]);

    Route::resource(
        'categories',
        CategoryController::class
    );

    Route::get(
    '/payments',
    [PaymentController::class,'index']
    )
    ->name('admin.payments.index');


    Route::get(
    '/payments/{order}',
    [PaymentController::class,'show']
    )
    ->name('admin.payments.show');


    Route::put(
    '/payments/{order}',
    [PaymentController::class,'update']
    )
    ->name('admin.payments.update');

    Route::get(
    '/customers',
    [CustomerController::class,'index']
    )
    ->name('admin.customers.index');



    Route::get(
    '/customers/{customer}',
    [CustomerController::class,'show']
    )
    ->name('admin.customers.show');

    // Manajemen Sales
    Route::get('/sales', [SalesController::class, 'index'])
        ->name('admin.sales.index');

    Route::get('/sales/create', [SalesController::class, 'create'])
        ->name('admin.sales.create');

    Route::post('/sales', [SalesController::class, 'store'])
        ->name('admin.sales.store');
    
    Route::delete('/sales/{user}', [SalesController::class, 'destroy'])
        ->name('admin.sales.destroy');
    
    Route::get('/sales/commissions', [
        \App\Http\Controllers\Admin\SalesController::class,
        'commissions',
    ])->name('sales.commissions');

    Route::post('/sales/commissions/{order}/paid', [
        \App\Http\Controllers\Admin\SalesController::class,
        'markPaid',
    ])->name('sales.commissions.paid');


});

Route::get('/',
[HomeController::class,'index'])
->name('home');

Route::get('/products/{slug}', [CustomerProductController::class, 'show'])
    ->name('customer.products.show');

Route::get('/cart',
[CartController::class,'index'])
->name('cart.index');


Route::middleware('auth')->group(function(){


    Route::post(
        '/cart/add/{product}',
        [CartController::class,'add']
    )
    ->name('cart.add');


});


Route::delete('/cart/remove/{id}',
[CartController::class,'remove'])
->name('cart.remove');

Route::post('/cart/update',
[CartController::class,'update'])
->name('cart.update');

Route::post('/cart/update-ajax',
[CartController::class,'updateAjax'])
->name('cart.update.ajax');

Route::get('/categories', function () {


    $categories = Category::withCount('products')
        ->get();


    return view(
        'customer.pages.categories',
        compact('categories')
    );


})->name('categories');

Route::get('/shop', [CustomerProductController::class,'index'])
    ->name('shop');

Route::middleware('auth')->group(function(){


    Route::get(
        '/checkout',
        [CheckoutController::class,'index']
    )
    ->name('checkout');


    Route::post(
        '/checkout',
        [CheckoutController::class,'store']
    )
    ->name('checkout.store');


});


Route::get('/checkout/success/{order}',
[CheckoutController::class,'success'])
->name('checkout.success');

Route::middleware('auth')->group(function(){


    Route::get(
        '/my-orders',
        [CustomerOrderController::class,'index']
    )
    ->name('customer.orders.index');



    Route::get(
        '/my-orders/{order}',
        [CustomerOrderController::class,'show']
    )
    ->name('customer.orders.show');


});

Route::get('/logout', function(){

    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/');

});


Route::get('/about', [PageController::class,'about'])
    ->name('about');


Route::get('/contact', [PageController::class,'contact'])
    ->name('contact');


Route::get('/shipping', [PageController::class,'shipping'])
    ->name('shipping');


Route::get('/payment', [PageController::class,'payment'])
    ->name('payment');


Route::middleware('auth')
    ->prefix('sales')
    ->name('sales.')
    ->group(function () {
        Route::get('/dashboard', [
            SalesDashboardController::class,
            'index'
        ])->name('dashboard');
    });


require __DIR__.'/auth.php';
