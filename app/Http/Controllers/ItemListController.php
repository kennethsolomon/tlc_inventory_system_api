<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemListResource;
use App\Models\Item;
use App\Models\ItemList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemListResource::collection(ItemList::all())->response()->setStatusCode(200);
    }

    public function update(Request $request)
    {
        $item_list = Itemlist::whereId($request->id)->first();

        if ($item_list->quantity >= $request->quantity) {
            $item_list->quantity -= $request->quantity;
            $item_list->save();
        } else {
            throw new Exception("Not enough stock, Invalid Operation.", 500);
        }

        $item = Item::where([['description', '=', $item_list->description], ['quantity', '>=', $request->quantity]])->first();
        if ($item) {
            $item->quantity -= $request->quantity;
            $item->save();
        } else {
            throw new Exception("Not enough stock, Invalid Operation.", 500);
        }
    }
}
