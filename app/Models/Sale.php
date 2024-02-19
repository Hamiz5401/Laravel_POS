<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Support\Facades\Redirect;
use App\Models\SaleLineItem;
use Illuminate\Http\Request;
use App\Http\Controllers\SaleController;

class Sale extends Model
{
    use HasFactory;

    public function sales_line_item(): HasMany {
        return $this->hasMany(SaleLineItem::class);
    }

    public function payment(): HasOne {
        return $this->hasOne(Payment::class);
    }   

    public function create_line_item(Request $request) {
        $sale_line_item = SaleLineItem::where('sale_id', '=', $request->id)->where('item_id', '=', $request->item_id)->first();

        if($sale_line_item != null) {
            $sale_line_item->increment('amount', $request->amount);
            $sale_line_item->increment('total_price', ($request->amount * $sale_line_item->item->price));
        }
        else {
            $new_saleLineItem = new SaleLineItem;

            $new_saleLineItem->sale_id = $request->id;
            $new_saleLineItem->item_id = $request->item_id;
            $new_saleLineItem->amount = $request->amount;
            $new_saleLineItem->save();
            
            $new_saleLineItem->increment('total_price', ($new_saleLineItem->amount * $new_saleLineItem->item->price));
        }

        SaleController::update_payment_paid_amount($request);

        return Redirect::route('dashboard');
    }

    public function destroy_line_item(Request $request){
        $sale_line_item = SaleLineItem::where('id', '=', $request->sale_item_id)->first();
        $sale_line_item->decrement('total_price', $sale_line_item->total_price);
        SaleController::update_payment_paid_amount($request);
        $sale_line_item->delete();

        return Redirect::route('dashboard');
    }
}
