<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleController;
use App\Models\Sale;
use App\Http\Controllers\MemberController;

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
    return redirect('/items');;
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
    elseif($sale->payment->paid == TRUE)
    {
        return Redirect::route('sale.create');
    }

    $payment_amount = $sale->payment->paid_amount;

    return view('dashboard')->with('sale', $sale)
                            ->with('sale_id', $sale->id)
                            ->with('total_price', $payment_amount)
                            ->with('sale_items', $sale->sales_line_item()->get())
                            ->with('items', ItemController::get_all_items());
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/member', function (Request $request) {

    $members = MemberController::get_all_members($request);

    return view('member')->with('members', $members);
})->middleware(['auth', 'verified'])->name('member');

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

    Route::post('/member_create', [MemberController::class, 'create_member'])->name('member.create');
    Route::post('/member_delete', [MemberController::class, 'delete_member'])->name('member.delete');

    Route::patch('/payment_member', [SaleController::class, 'add_member_to_sale'])->name('payment.update_member');
    Route::patch('/payment', [SaleController::class, 'process_payment'])->name('payment.update');
});

require __DIR__.'/auth.php';
