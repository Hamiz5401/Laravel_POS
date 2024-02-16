<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Redirect;

class SaleController extends Controller
{
    public static function get_sale_from_cashier(Request $request)
    {
        return Sale::where('cashier_id', '=', $request->user()->id)->orderBy('id', 'DESC')->first();
    }

    public function create_sale(Request $request)
    {
        $sale = new Sale;
        $sale->cashier_id = $request->user()->id;
        $sale->save();

        return Redirect::route('dashboard');
    }
}
