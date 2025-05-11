<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download(int $id) {
        $file = File::findOrFail($id);

        return Storage::disk('public')->download($file->path, $file->name);
    }
}
