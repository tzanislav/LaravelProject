<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Animal;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{
    function getData(Request $req)
    {
        
    }

    function Index()
    {
        if(session()->has('user'))
        {
            return redirect('home');
        }
        return view('login');
    }

    function Submit (Request $req)
    {
        $req->validate([
            'first_name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
        ]);
        


        DB::table('users')->insert([
            'name' => $req->first_name,
            'email' => $req->email,
        ]);
        return redirect('login');

    }

    function Login (Request $req)
    {
        $data = $req->input();
        $req->session()->put('user', $data['email']);
        return redirect('home');
    }

    function AddMember (Request $req)
    {
        $user = new Animal;

        $user->name = $req->name;
        $user->email = $req->email;
        $user->save();
        return redirect('AddMember');
     }



}