<?php

namespace App\Http\Controllers;

use App\Models\GenerateMR;
use Illuminate\Http\Request;

class GenerateMRController extends Controller
{
    public function index()
    {
        $mr = [];
        $mr_data = GenerateMR::all();

        foreach ($mr_data as $data) {
            array_push($mr, [
                'id' => $data->id,
                'mr_number' => $data->mr_number,
                'f_date' => $data->f_date,
                'type' => $data->type,
                'selected' => json_decode($data->selected, true),
            ]);
        }

        info($mr);

        return $mr;
    }
}
