<?php

namespace App\Http\Controllers;

use App\Models\GenerateMR;
use Illuminate\Http\Request;

class GenerateMRController extends Controller
{
    public function index()
    {
        return GenerateMR::all();
    }
}
