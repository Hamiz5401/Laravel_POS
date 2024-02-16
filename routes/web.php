<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleController;
use App\Models\Sale;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/items', function (Request $request) {

    $items = ItemController::get_all_items();
    
    return view('items')->with('items', $items);
})->middleware(['auth', 'verified'])->name('items');

Route::get('/items-create', function (Request $request) {
    return view('item-create-form');
})->middleware(['auth', 'verified'])->name('items-create');

Route::get('/dashboard', function (Request $request) {
    $sale = SaleController::get_sale_from_cashier($request);

    if($sale == null) {
        return Redirect::route('sale.create');
    }

    return view('dashboard')->with('sale', $sale)
                            ->with('total_price', array_sum($sale->sales_line_item()->pluck('total_price')->all()))
                            ->with('sale_items', $sale->sales_line_item()->get())
                            ->with('items', ItemController::get_all_items());
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/item', [ItemController::class, 'create_item'])->name('item.create');
    Route::patch('/item', [ItemController::class, 'update_item'])->name('item.update');
    Route::delete('/item', [ItemController::class, 'destroy_item'])->name('item.destroy');

    Route::get('/sale', [SaleController::class, 'create_sale'])->name('sale.create');

    Route::post('/add_line_item', [Sale::class, 'create_line_item'])->name('saleLineItem.create');
    Route::delete('/delete_item', [Sale::class, 'destroy_line_item'])->name('saleLineItem.delete');
});

require __DIR__.'/auth.php';
