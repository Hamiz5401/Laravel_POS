<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public static function get_all_items()
    {
        return Items::get();
    }

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

        $item = new Items;
        $item->name = $request->new_item_name;
        $item->description = $request->new_item_description;
        $item->amount = $request->new_amount;
        $item->price = $request->new_price;

        $item->save();

        return redirect('items');
    }

    public function update_item(Request $request)
    {
        $request->validate([
            'amount' => 'numeric',
            'price' => 'numeric',
        ],[
            'amount.numeric' => 'amount must be a number',
            'price.numeric' => 'price must be a number',
        ]);

        $item = Items::where('id', '=', $request->item_id)->first();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->amount = $request->amount;
        $item->price = $request->price;
        $item->save();

        return redirect('items');
    }

    public function destroy_item(Request $request)
    {
        Items::where('id', '=', $request->item_id)->delete();
        return redirect('items');
    }
}
