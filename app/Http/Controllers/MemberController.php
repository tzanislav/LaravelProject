<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    function show()
    {
        $data = Animal::paginate(5);
        return view('list', ['users'=>$data]);
    }

    function destroy($id)
    {
        $data = Animal::find($id);
        $data->delete();
        echo "<script>console.log('ID: ".$id."')</script>";
        return redirect('list');
    }
    //
}
