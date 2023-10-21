<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{
    function getData(Request $req)
    {
        
    }

    function Index()
    {
        return view('login');
    }

    function Submit (Request $req)
    {

        


        DB::table('users')->insert([
            'name' => $req->first_name,
            'email' => $req->email,
        ]);
        return redirect('login');

    }

    function Login (Request $req)
    {
        $req->validate([
            'first_name' => 'exists:users,name',
            'email' => 'required|email|unique:users,email',
        ]);
        $data = $req->input();
        $req->session()->put('user', $data['email']);
        return redirect('home');
    }

    function AddMember (Request $req)
    {
        $user = new User;

        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $user->name = $req->name;
        $user->email = $req->email;
        $user->save();
        return redirect('home');
     }



}