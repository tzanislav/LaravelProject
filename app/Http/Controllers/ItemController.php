<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    //
    function show()
    {
        $items = Product::paginate(50);
        return view('list', ['products'=>$items]);
    }

    public function filter(Request $request)
    {
        $filter = $request->input('filter');
        if(!$filter) {
            return redirect('list');
        }
    
        // Extract the filter criteria from the URL parameter
        $filterParts = explode(':', $filter);
        $filterField = $filterParts[0];
        $filterValue = $filterParts[1];
    
        // You can add validation and sanitation for the filter input here
    
        // Build the query to filter based on the provided field and value
        $items = Product::where($filterField, $filterValue)
                    ->orderBy("company", "desc")
                    ->paginate(20);

        $items->appends(['filter' => $filter]);         
        return view('list', ['products' => $items, 'filter' => $filter, 'paginationURL ']);
    }
    


    function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        echo "<script>console.log('ID: ".$id."')</script>";
        return redirect('list');
    }

    function AddItem(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'count' => 'required',
            'category' => 'required',
            // Add validation rules for other fields as needed
        ]);
    
        $item = new Product;
        $item->name = $req->name;
        $item->room = $req->room;
        $item->count = $req->count;
        $item->category = $req->category;
        $item->measure = $req->measure;
        $item->company = $req->company;
        $item->description = $req->description;
        $item->status = $req->status;
        $item->proforma = $req->proforma;
        $item->created_at = now();
        $item->updated_at = now();
        $item->save();
    
        return redirect('list');
    }

    public function search(Request $request) {
        $search = $request->input('search');
    
        $products = Product::where(function($query) use ($search) {
            $query->where('itemName', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('company', 'like', '%' . $search . '%');
                })->paginate(10)->setPath('search') ;                  
        
        $products->appends(['search' => $search]);

        return view('list', ['products' => $products, 'search' => $search]);
    }
    
    

     function Test (Request $req)
     {
        return $req->input();
     }
}
