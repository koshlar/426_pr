<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  public function index()
  {
    return view('pages.products.index', ['products' => Product::all()]);
  }

  public function show($id)
  {
    return view('pages.products.show', ['product' => Product::findOrFail($id)]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pages.products.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|min:2',
      'price' => 'required|string|between:0,1000000',
      'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:3000',
      'description' => 'required|string|between:10,1500',
    ]);

    if ($request->hasFile('image')) {
      Storage::disk("public")->makeDirectory('images/products');

      $filename = basename($request->file('image')->store('images/products', 'public'));
    }

    Product::create([
      'name' => $request->name,
      'price' => $request->price,
      'description' => $request->description,
      'image' => $filename,
    ]);

    return redirect(route('products.index'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    return view('pages.products.edit', ['product' => Product::findOrFail($id)]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|min:2',
      'price' => 'required|string|between:0,1000000',
      'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3000',
      'description' => 'required|string|between:10,1500',
    ]);

    $product = Product::findOrFail($id);

    if ($request->hasFile('image')) {
      Storage::disk("public")->makeDirectory('images/products');

      $filename = basename($request->file('image')->store('images/products', 'public'));

      $product->update(['image' => $filename]);
    }

    $product->update([
      'name' => $request->name,
      'price' => $request->price,
      'description' => $request->description,
    ]);

    return redirect(route('products.index'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $product = Product::findOrFail($id);

    $product->delete();

    return redirect(route('products.index'));
  }
}
