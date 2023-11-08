<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    function Index()
    {
        //Check user clearance
        if (auth()->user()->clearance < 1) {
            return redirect('/');
        }

        $users = User::all();
        return view('adminPanel', ['users' => $users]);
    }

    function Update(Request $request)
    {
        $user = User::find($request->id);
        $user->clearance = $request->clearance;
        $user->save();
        return redirect('/admin');
    }
    //
}
