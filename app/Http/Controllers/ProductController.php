<?php

namespace App\Http\Controllers;
use \Illuminate\Database\QueryException;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Category;
use App\SubCategory;
use App\Size;
use App\Image;



class ProductController extends Controller
{
    public function add()
    {
      $categories = Category::all();
      return view('products.add', compact('categories'));
    }


    public function commit(ProductRequest $request)
    {
      $request->validated();
      $new_product = Product::create($request->all());
      $new_product->create_sizes($request->size_values, $request->size_quantities);
      app('App\Http\Controllers\ImageController')->set_new_added_images($new_product->id);
      return redirect('/')->with('success', 'Product added successfully');
    }


    public function edit($id)
    {
      try{
        $instance = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('instance', 'categories'));
      }
      catch(QueryException $e){
        return redirect('/')->withErrors('Product not found');
      }
    }


    public function update(ProductRequest $request, $id)
    {
      $request->validated();
      $product = Product::find($id)->update($request->all());
      $product->delete_sizes();
      $product->create_sizes($request->size_values, $request->size_quantities);
      app('App\Http\Controllers\ImageController')->delete_removed_images($request->removed);
      app('App\Http\Controllers\ImageController')->set_new_added_images($new_product->id);
      return redirect('/')->with('success', 'Product edited successfully');
    }


    public function delete(Request $request)
    {
      try{
        $id = $request->product_id;
        Product::find($id)->delete();
        return redirect('/')->with('success', 'Deleted product');
      }
      catch (QueryException $e){
        return redirect('/')->withErrors('Product not found');
      }
    }
}