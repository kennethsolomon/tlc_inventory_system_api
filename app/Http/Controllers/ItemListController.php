<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemListResource;
use App\Models\ItemList;
use Illuminate\Http\Request;

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
}
