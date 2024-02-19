<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Redirect;
use App\Models\Payment;
use App\Models\Member;

class SaleController extends Controller
{
    public static function get_sale_from_cashier(Request $request)
    {
        return Sale::where('cashier_id', '=', $request->user()->id)->orderBy('id', 'DESC')->first();
    }

    public static function update_payment_paid_amount(Request $request)
    {
        $target_sale = SaleController::get_sale_from_cashier($request);
        $sum_total_price = array_sum($target_sale->sales_line_item()->pluck('total_price')->all());
        $payment = Payment::where('sale_id', '=', $request->id)->orderBy('id', 'DESC')->first();
        $payment->paid_amount = $sum_total_price;

        $payment->save();
    }

    public function create_payment(Request $request)
    {
        $target_sale = $this->get_sale_from_cashier($request);
        $sum_total_price = array_sum($target_sale->sales_line_item()->pluck('total_price')->all());
        $payment = new Payment;
        $payment->sale_id = $target_sale->id;
        $payment->paid_amount = $sum_total_price;

        $payment->save();
    }

    public function create_sale(Request $request)
    {
        $sale = new Sale;
        $sale->cashier_id = $request->user()->id;
        $sale->save();

        $this->create_payment($request);

        return Redirect::route('dashboard');
    }

    public function add_member_to_sale(Request $request)
    {
        $member = Member::where('citizen_id', '=', $request->citizen_id)->first();

        if($member == null) {
            return Redirect::route('dashboard');
        }
        $target_sale = $this->get_sale_from_cashier($request);
        $total_price = array_sum($target_sale->sales_line_item()->pluck('total_price')->all());
        $payment = Payment::where('sale_id', '=', $request->sale_id)->first();
        $payment->member_id = $member->id;
        $payment->paid_amount = $total_price * 0.9;
        $payment->save();


        /*$target_sale_line_items = $target_sale->sales_line_item();
        $target_sale_line_items->save();*/

        return Redirect::route('dashboard');
    }

    public function process_payment(Request $request)
    {
        $payment = Payment::where('sale_id', '=', $request->sale_id)->first();
        $payment->paid = TRUE;
        $payment->save();

        return Redirect::route('dashboard');
    }
}
