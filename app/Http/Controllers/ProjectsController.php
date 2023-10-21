<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    public function listUniqueItems()
    {
        $uniqueItems = Product::select('project')->distinct()->get();
        $testTitle = "Test Title";

        return view( 'home', compact( 'uniqueItems', 'testTitle') );
    }
}
