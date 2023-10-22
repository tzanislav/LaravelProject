<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::all()->sortByDesc('created_at');
        return view('logView', ['logs' => $logs]);      
    }
    //
}
