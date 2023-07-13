<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;
use Carbon\Carbon;

class ProductController extends Controller
{
    
    public function add()
    {
        return view('add');
    }

    public function list()
    {
        $products = Product::all();
        return view('dashboard', compact('products'));
    }

    public function insert(Request $req)
    { 
        $product = new Product();
        $product->name = $req->name;
        $product->category_name = $req->category;
        $product->brand_name = $req->brand;
        $product->description = $req->description;
        if($req->hasFile('image'))
        {
            $file = $req->file('image');
            $filename = uniqid().$file->getClientOriginalName();
            $file->move('uploads/', $filename);
            $product->image = $filename;
        }
        
        $product->save();
        Session::flash('message', 'Product has been added Successfully');
        return redirect()->route('dashboard');
    }

    public function delete(Request $req)
    {
        $product = Product::find($req->id);
        $path = public_path('uploads/'.$product->image);
        if(file_exists($path))
        {
            unlink($path);
        }
        $product->delete();
        Session::flash('message', 'Product has been deleted Successfully');
        return redirect()->route('dashboard');
    }

    public function edit(Request $req)
    {
        $edit = Product::find($req->id);
        return view('edit', compact('edit'));
    }

    public function update(Request $req)
    {
        $product = Product::find($req->id);
        $product->name = $req->name;
        $product->category_name = $req->category;
        $product->brand_name = $req->brand;
        $product->description = $req->description;
        if($req->hasFile('newimage'))
        {
            $destination = public_path('uploads/'.$req->oldimage);
            if(file_exists($destination)){
                unlink($destination);
            }
            $file = $req->file('newimage');
            $filename = uniqid().$file->getClientOriginalName();
            $file->move('uploads/', $filename);
            $product->image = $filename;
        }
        
        $product->update();
        Session::flash('message', 'Product is Updated Successfully');
        return redirect()->route('dashboard');
    }

    public function add_cart(Request $req)
    {
         $crud = Product::find($req->id);
         
         if($req->status==1)
         {
            $crud->is_active = 0;
            $crud->change_status_time = Carbon::now();
         }
         $crud->update();
         Session::flash('message', 'Product is Added in the Cart');
         return redirect()->route('product_cartList');
    }

    public function remove_cart(Request $req)
    {
         $crud = Product::find($req->id);
         
         if($req->status==0)
         {
            $crud->is_active = 1;
            $crud->change_status_time = Carbon::now();
         }
         $crud->update();
         Session::flash('message', 'Product is removed from the Cart');
         return redirect()->route('product_cartList');
    }

    public function cart(Request $req)
    {
        $products = Product::all();
        return view('cart', compact('products'));
    }
    
}
