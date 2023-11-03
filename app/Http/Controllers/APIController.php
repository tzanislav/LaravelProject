<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use App\Models\Status;

class APIController extends Controller
{
    //
    function getData()
    {
        $data = Product::all(); // Replace 'Data' with your model name
        return response()->json($data);
    }
    function getCategories()
    {
        $data = Category::all(); // Replace 'Data' with your model name
        return response()->json($data);
    }
    function getCompanies()
    {
        $data = Company::all(); // Replace 'Data' with your model name
        return response()->json($data);
    }
    function getStatues()
    {
        $data = Status::all(); // Replace 'Data' with your model name
        return response()->json($data);
    }
}
