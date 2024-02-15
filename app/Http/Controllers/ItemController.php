<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create_item(Request $request)
    {
        $request->validate([
            'new_item_name' => 'required',
            'new_item_description' => 'required',
            'new_amount' => 'required|numeric',
            'new_price' => 'required|numeric',
        ], [
            'new_item_name.required' => 'New item name can not be blank.',
            'new_amount.required' => 'New item amount can not be blank.',
            'new_price.required' => 'New item price can not be blank.',
            'new_amount.numeric' => 'New item amount must be a number.',
            'new_price.numeric' => 'New item price must be a number.',
        ]);

        $item = new Item;
        $item->name = $request->new_item_name;
        $item->amount = $request->new_stock;
        $item->price = $request->new_price;

        $item->save();

        return;
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $item = Item::where('id', '=', $request->item_id)->first();
        $item->name = $request->name;
        $item->amount = $request->amount;
        $item->price = $request->price;
        $item->save();

        $affected = $item->sales_line_item()->get();
        foreach($affected as $to_update_item) {
            if($to_update_item->sale->payment->payment_type != 'unfinished') {
                continue;
            }
            $to_update_item->total = $to_update_item->quantity * $item->price;
            $to_update_item->save();
        }

        return;
    }

    public function destroy(Request $request)
    {
        Item::where('id', '=', $request->item_id)->delete();
        return;
    }
}
