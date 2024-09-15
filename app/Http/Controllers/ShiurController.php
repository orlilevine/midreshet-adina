<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shiur;
use App\Models\Series;

class ShiurController extends Controller
{

    public function index($id = null)
    {
        // If an ID is provided, fetch that specific shiur
        if ($id) {
            $shiur = Shiur::findOrFail($id);
            return view('shiurs.index', compact('shiur'));
        }

        // If no ID is provided, fetch all shiurs
        $shiurs = Shiur::all();
        return view('shiurs.index', compact('shiurs'));
    }





}
