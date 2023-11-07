<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('uploads', 's3','public');
        $url = Storage::disk('s3')->url($path);

        // Return a JSON response with the URL
        return response()->json(['success' => true, 'url' => $url]);
    }

    // Return a JSON response for the case of a failed upload
    return response()->json(['success' => false]);
}
}
