<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrototypingController extends Controller
{
    public function index() {
        return view('prototyping.index');
    }
}
