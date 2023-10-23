<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Log;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{
    
    //
    function show()
    {
        $currentProject = session()->get( 'project' );

        if (session()->has( 'user' )) {
            $data = Product::where( 'project', $currentProject )->paginate(50);

            return view( 'list', ['products' => $data], ['currentProject' => $currentProject] );
        } else {
            return redirect( 'login' );
        }
    }


    public function filter(Request $request)
    {
        $filter = $request->input( 'filter' );
        if (!$filter) {
            return redirect( 'list' );
        }

        // Extract the filter criteria from the URL parameter
        $filterParts = explode( ':', $filter );
        $filterField = $filterParts[0];
        $filterValue = $filterParts[1];

        // You can add validation and sanitation for the filter input here

        // Build the query to filter based on the provided field and value
        $items = Product::where( $filterField, $filterValue )
            ->where( 'project', session()->get( 'project' ) )
            ->orderBy( "room", "desc" )
            ->paginate( 50 );

        $items->appends( ['filter' => $filter] );
        return view( 'list', ['products' => $items, 'filter' => $filter, 'paginationURL '] );
    }



    function destroy($id)
    {
        if (session()->has( 'user' )) {
            $data = Product::find( $id );
            
            $log = new Log;
            $log->type = "delete";
            $log->content = "Item: " . $data->itemName . " deleted";
            $log->owner = session()->get( 'user' );
            $log->save();

            $data->delete();

            return redirect()->back()->with('success', 'Record updated successfully');
        } else {
            return redirect( 'login' );
        }
    }
    function Update($id, Request $req)
    {
        session()->flash('form', 'editItem');

        foreach ($req->all() as $key => $value) {
            if (strpos($value, '"') !== false) {
                return redirect()->back()->withErrors('Please do not use double quotes in the form');
            }
        }

        if (session()->has( 'user' )) {
            $data = Product::find( $id );

            //Compare the old and new values
            $oldValues = $data->toArray();
            $newValues = $req->all();
            $changes = array();

            foreach ($oldValues as $key => $value) {
                if (array_key_exists($key, $newValues) && $oldValues[$key] != $newValues[$key]) {
                    $changes[$key] = $newValues[$key];
                                //Log the changes
                    $log = new Log;
                    $log->type = "update";
                    $log->content = "Item: <b>" . $data->itemName . "</b> " . $key . " changed from " . $oldValues[$key] . " to <b>" . $newValues[$key] . "</b>";
                    $log->owner = session()->get( 'user' );
                    $log->save();
                }
            }



            

            $data->itemName = $req->itemName;
            $data->room = $req->room;
            $data->count = $req->count;
            $data->category = $req->category;
            $data->measure = $req->measure;
            $data->company = $req->company;
            $data->provider = $req->provider;
            $data->description = $req->description;
            $data->status = $req->status;
            $data->proforma = $req->proforma;
            $data->save();
            return redirect()->back()->with('success', 'Record updated successfully');
            
        } else {
            return redirect( 'login' );
        }
    }

    function AddItem(Request $req)
    {
        session()->flash('form', 'addItem');
        $req->validate([
            'itemName' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'room' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'count' => 'required|numeric',
            'category' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'measure' => 'regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'company' => 'regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'provider' => 'regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'status' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
        ]);


        if (session()->has( 'user' )) {
            $data = new Product;
            $data->project = session()->get( 'project' );
            $data->itemName = $req->itemName;
            $data->room = $req->room;
            $data->count = $req->count;
            $data->category = $req->category;
            $data->measure = $req->measure;
            $data->company = $req->company;
            $data->provider = $req->provider;
            $data->description = $req->description;
            $data->status = $req->status;
            $data->proforma = $req->proforma;
            $data->save();

            $log = new Log;
            $log->type = "add";
            $log->content = "Item: " . $data->itemName . " added to " . $data->room;
            $log->owner = session()->get( 'user' );
            $log->save();


            return redirect()->back()->with('success', $data->itemName . ' added successfully to ' . $data->room );
            
        } else {
            return redirect( 'login' );
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $project = session()->get('project'); // Retrieve the project from the session
    
        $products = Product::where('project', $project) // Filter by project
            ->where(function ($query) use ($search) {
                $query
                    ->where('itemName', 'like', '%' . $search . '%')
                    ->orWhere('room', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('company', 'like', '%' . $search . '%');
            })
            ->paginate(50)
            ->setPath('search');
    
        $products->appends(['search' => $search]);
    
        return view('list', ['products' => $products, 'search' => $search]);
    }



    function Test(Request $req)
    {
        return $req->input();
    }

    function SetProject(Request $req)
    {
        $project = $req->project;
        session()->put( 'project', $project );
        return redirect( 'list' );
        
    }
}
