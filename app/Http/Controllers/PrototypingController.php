<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prototype;
use Barryvdh\DomPDF\Facade\Pdf;

class PrototypingController extends Controller
{
    public function index(Request $request) {
        $prototypes = Prototype::query()
            ->when($request->model, function($query, $model) {
                return $query->where('model_detail', 'like', "%{$model}%");
            })
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->date, function($query, $date) {
                return $query->whereDate('date_exp', $date);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('prototype.index', compact('prototypes'));
    }

    public function create() {
        return view('prototype.create');
    }
    public function store(Request $request)
    {
        $prototypeData = $request->validate([
            'number_exp' => 'required',
            'model_detail' => 'required',
            'date_exp' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        Prototype::create($prototypeData);
        return redirect()->route('prototype.index');
    }

    public function edit(int $id) {
        $prototype = Prototype::find($id);
        return view('prototype.edit',compact('prototype'));
    }
    public function update(Request $request, int $id) {
        $prototypeData = $request->validate([
            'number_exp' => 'required',
            'model_detail' => 'required',
            'date_exp' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        $prototype = Prototype::find($id);
        $prototype->update($prototypeData);

        return redirect()->route('prototype.index');
    }

    public function destroy(int $id) {
        Prototype::destroy($id);
        return redirect()->route('prototype.index');
    }

    public static function generateReport() {
        $prototypes = Prototype::all();
        $date = date('d-m-Y');
        $percentCompletedExp = Prototype::completedExp();

        $pdf = PDF::loadView('prototype.report', compact('prototypes', 'date', 'percentCompletedExp'));
        return $pdf->download('report_prototypes'.'.pdf');
    }
}
