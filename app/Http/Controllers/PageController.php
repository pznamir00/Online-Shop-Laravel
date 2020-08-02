<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Product;
use App\Category;
use App\SubCategory;
use Illuminate\Support\Facades\DB;


class PageController extends Controller
{
    private $default_paginate = 20;


    public function index()
    {
        $products = Product::where('active', '1')
                    ->orderBy('id', 'DESC')
                    ->paginate($this->default_paginate);
        $categories = Category::all();
        return view('pages.index', compact('products', 'categories'));
    }

    public function one_product($id)
    {
        try{
          $product = Product::find($id);
          return view('pages.one_product', compact('product'));
        }
        catch(QueryException $e){
          return redirect('/')->withErrors('Product not found');
        }
    }

    public function categories($cat, $subcat)
    {
        try{
          $subcat_id = SubCategory::where('slug', $subcat)->pluck('id');
          $products = Product::where('active', '1')
                      ->where('category_id', $subcat_id)
                      ->orderBy('id', 'DESC')
                      ->paginate($this->default_paginate);
          $categories = Category::all();
          return view('pages.products_list', compact('products', 'categories'));
        }
        catch(QueryException $e){
          return redirect('/')->withErrors('Category not found');
        }
    }

    public function keywords()
    {
        if(!request()->has('keywords') || request('keywords') == '')
          return redirect('/');
        $key = request('keywords');
        $products = Product::where('active', '1')
                    ->where('title', 'like', '%'.$key.'%')
                    ->orWhere('description', 'like', '%'.$key.'%')
                    ->orderBy('id', 'DESC')
                    ->paginate($this->default_paginate);
        $categories = Category::all();
        return view('pages.products_list', compact('products', 'categories'));
    }
}
                                                                                                                                                                                  
