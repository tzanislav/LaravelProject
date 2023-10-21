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

        return view( 'home', ['uniqueItems' => $uniqueItems] );
    }
}
