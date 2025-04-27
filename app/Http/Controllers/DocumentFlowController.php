<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentFlowController extends Controller
{
    public function index() {
        return view('document-flow.index');
    }
}
