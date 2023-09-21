<?php

namespace App\Http\Controllers;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index()
    {
        $category = category::all();
        return view('addProduct',compact('category'));
    }
    public function store(Request $req)
    {
        $active = $req->has('active') ? 1 : 0;
        $data = $req->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
        ],
        [
            'name.required' => 'The Product name is required.',
            'category.required' => 'Please Select Category',
            'description.required' => 'Please Enter Description',
          
        ]);
        
        $product = new product();
        $product->name = $req->name;
        $product->category = $req->category;
        $product->description = $req->description;
        $product->active = $active;
        $product->save();
        return redirect()->route('show.product')->with('success', 'Product Added.');

    
    }
    public function show()
    {
        // $product= product::where('active_flag', true, 10)->get();
        $product= product::where('delete_flag', 'N')->orderByDesc('created_at')->get();
       // echo"<pre>";
       // print_r($product);die;
        return view('producList',compact('product'));
    }
    public function update($id)
    {
        $category = category::all();
        $product= product::where('id', $id)->get();
        
        return view('editList',compact('product','category'));
    }
    public function updateInsertion(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            // Add validation rules for other fields
        ]);
        $data['active'] = $req->has('active');
        $id = $req->id;
        $product = product::find($id);
        $product->name = $req->name;
        $product->category = $req->category;
        $product->description = $req->description;
        $product->active = $req->flag;
        $product->save();
        return response()->json(['message' => 'Product updated successfully']);
    }

    public function delete($id)
    {
        $product = product::find($id);
        $affectedRows = Product::where('id', $id)
        ->update([
            'delete_flag' => 'Y',
        ]);
        return redirect()->route('show.product')->with('message', 'Product Deleted successfully');
    
       
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $product = Product::where('name', 'LIKE', "%$query%")->get();
        return view('searchData',compact('product'));
    }
    public function getData(Request $request)
    {
        $category = $request->input('category');
        if($category == '1')
        {
            $product = Product::where('active', 'true')->orderByDesc('created_at')->get();
            return view('searchData',compact('product'));
        }else{
            $product = Product::where('active', 'false')->orderByDesc('created_at')->get();
            return view('searchData',compact('product'));
        }

    }
       
    
}
