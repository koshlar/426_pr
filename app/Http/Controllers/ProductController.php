<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  public function index(Request $request)
  {
    $products = Product::query();

    if ($request->input('pci')) {
      $products->where('product_category_id', $request->input('pci'));
    }

    return view('pages.products.index', ['products' => $products->get(), 'categories' => ProductCategory::all()]);
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
    return view('pages.products.create', ['categories' => ProductCategory::all()]);
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
      'product_category_id' => 'required|string|exists:product_categories,id',
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
      'product_category_id' => $request->product_category_id,
    ]);

    return redirect(route('products.index'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    return view('pages.products.edit', ['product' => Product::findOrFail($id), 'categories' => ProductCategory::all()]);
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
      'product_category_id' => 'required|string|exists:product_categories,id',
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
      'product_category_id' => $request->product_category_id,
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
