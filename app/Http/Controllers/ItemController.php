<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$shownItems = null;

class ItemController extends Controller
{

    //
    function show()
    {
        global $shownItems;

        $filterList = session()->get( 'filterList' );
        if ($filterList == null) {
            $filterList = array();
        }
        $currentProject = session()->get( 'project' );
        $shownItems = Product::where( 'project', $currentProject );
        foreach ($filterList as $filter) {
            $filterParts = explode( ':', $filter );
            $filterField = $filterParts[0];
            $filterValue = $filterParts[1];
            $shownItems = $shownItems->where( $filterField, $filterValue );
        }
        $shownItems = $shownItems->orderBy( 'room', 'desc' )->paginate( 500 );
        return view( 'listVue', [
            'products' => $shownItems,
            'currentProject' => $currentProject,
            'filterList' => $filterList
        ] );

    }



    public function AddFilter(Request $req)
    {
        $filter = $req->filter;
        $filterList = session()->get( 'filterList' );
        if ($filterList == null) {
            $filterList = array();
        }
        array_push( $filterList, $filter );
        session()->put( 'filterList', $filterList );

        return redirect()->back();
    }

    public function RemoveFilter(Request $req)
    {
        $filter = $req->filter;
        $filterList = session()->get( 'filterList' );
        if ($filterList == null) {
            $filterList = array();
        }
        $filterList = array_diff( $filterList, array( $filter ) );
        session()->put( 'filterList', $filterList );
        return redirect()->back();
    }

    public function ClearFilters(Request $req)
    {
        session()->forget( 'filterList' );
        session()->forget( 'search' );
        return redirect()->back();

    }

    public function Search(Request $request)
    {
        $shownItems = Product::where( 'project', session()->get( 'project' ) );
        $search = $request->search;

        $shownItems = $shownItems->where( function ($query) use ($search) {
            $query->orWhere( 'itemName', 'like', '%' . $search . '%' )
                ->orWhere( 'room', 'like', '%' . $search . '%' )
                ->orWhere( 'company', 'like', '%' . $search . '%' )
                ->orWhere( 'provider', 'like', '%' . $search . '%' )
                ->orWhere( 'description', 'like', '%' . $search . '%' )
                ->orWhere( 'proforma', 'like', '%' . $search . '%' );

        } );

        $shownItems = $shownItems->orderBy( 'room', 'desc' )->paginate( 50 );

        return view( 'list', [
            'products' => $shownItems,
            'currentProject' => session()->get( 'project' ),

            'search' => $search
        ] );
    }





    function destroy($id)
    {

        $data = Product::find( $id );

        $log = new Log;
        $log->type = "delete";
        $log->content = "Item: " . $data->itemName . " deleted";
        $log->owner = Auth::user()->name;
        $log->save();

        $data->delete();

        return redirect()->back()->with( 'success', 'Record updated successfully' );

    }
    function Update($id, Request $req)
    {
        session()->flash( 'form', 'editItem' );

        foreach ($req->all() as $key => $value) {
            if (strpos( $value, '"' ) !== false) {
                return redirect()->back()->withErrors( 'Please do not use double quotes in the form' );
            }
        }

        $req->validate( [
            'itemName' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'room' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'count' => 'required|numeric',
            'category' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'measure' => 'regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'company' => 'regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'provider' => 'regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'status' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'image' => 'url',
        ] );


        $data = Product::find( $id );

        //Compare the old and new values
        $oldValues = $data->toArray();
        $newValues = $req->all();
        $changes = array();

        foreach ($oldValues as $key => $value) {
            if (array_key_exists( $key, $newValues ) && $oldValues[$key] != $newValues[$key]) {
                $changes[$key] = $newValues[$key];
                //Log the changes
                $log = new Log;
                $log->type = "update";
                $log->content = "Item: <b>" . $data->itemName . "</b> " . $key . " changed from " . $oldValues[$key] . " to <b>" . $newValues[$key] . "</b>";
                $log->owner = Auth::user()->name;
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
        $data->image = $req->image;
        $data->save();
        return redirect()->back()->with( 'success', 'Record updated successfully' );


    }

    function AddItem(Request $req)
    {
        session()->flash( 'form', 'addItem' );
        $req->validate( [
            'itemName' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'room' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'count' => 'required|numeric',
            'category' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'measure' => 'regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'company' => 'regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'provider' => 'regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'status' => 'required|regex:/[\p{L}\p{N}.,?!]+/u|not_in:"|max:255',
            'image' => 'url | image | max:2048',
        ] );



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
        $data->image = $req->image;
        $data->save();

        $log = new Log;
        $log->type = "add";
        $log->content = "Item: " . $data->itemName . " added to " . $data->room;
        $log->owner = Auth::user()->name;
        $log->save();


        return redirect()->back()->with( 'success', $data->itemName . ' added successfully to ' . $data->room );


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

    function EditItem (Request $req)
    { 
        $isNew = false;
        $data = Product::find( $req->id );


        if($data == null){
            error_log("Item not found, creating new");
            $newItem = new Product;
            $isNew = true;
            $newItem->project = session()->get( 'project' );
            $newItem->id = $req->id;
            $newItem->itemName = $req->itemName;
            $newItem->room = $req->room;
            $newItem->count = $req->count;
            $newItem->category = $req->category;
            $newItem->measure = $req->measure;
            $newItem->company = $req->company;
            $newItem->provider = $req->provider; 
            $newItem->description = $req->description; 
            $newItem->status = $req->status;
            $newItem->proforma = $req->proforma;
            $newItem->image = $req->image;
            $newItem->owner = Auth::user()->name;
  
            $newItem->save();
            error_log("Item: " . $newItem->itemName . " created");
            return redirect ( 'list' );
        }
        else{
            //Check for changes
            $oldValues = $data->toArray();
            $newValues = $req->all();
            $changes = array();
            foreach( $oldValues as $key => $value ){
                if(array_key_exists($key, $newValues) && $oldValues[$key] != $newValues[$key]){
                    $changes[$key] = $newValues[$key];
                }
            }
        }


        error_log("Gathering data" . $data);
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
        $data->image = $req->image;

        $data->save();

        foreach( $changes as $key => $value ){
            $log = new Log;
            $log->type = $isNew ? "Add" : "Update";
            $log->content = "Item: " . $data->itemName . " " . $key . " changed from " . $oldValues[$key] . " to " . $newValues[$key] ;
            $log->owner = Auth::user()->name;
            $log->save();
        }

        error_log("Item: " . $data->itemName . " updated");
    }

    function DeleteItem (Request $req)
    {
        $data = Product::find( $req->id );
        $data->delete();

        $log = new Log;
        $log->type = "delete";
        $log->content = "Item: " . $data->itemName . " deleted";
        $log->owner = Auth::user()->name;
        $log->save();

        error_log("Item: " . $data->itemName . " deleted");
        return redirect ( 'list' );
    }


}
