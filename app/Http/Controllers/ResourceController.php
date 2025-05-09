<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ResourceController extends Controller
{
    public function index() {
        $resources = Resource::paginate(10);
        return view('resource.index', compact('resources'));
    }

    public function create() {
        $users = User::all();
        return view('resource.create',compact('users'));
    }
    public function store(Request $request) {
        $resourceData = request()->validate([
            'number_report' => 'required',
            'resource_name' => 'required',
            'user_id' => 'required',
            'date_report' => 'required',
            'description' => 'required',
        ]);

        Resource::create($resourceData);

        return redirect()->route('resource.index');
    }

    public function generateReport() {
        $resources = Resource::all();
        $countResourcesUser = Resource::countResourcesUseUser();
        $pdf = PDF::loadView('resource.report', compact('resources', 'countResourcesUser'));
        return $pdf->download('report.pdf');

    }
}
