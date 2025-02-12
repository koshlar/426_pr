<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
  public function index()
  {
    return view('pages.categories.index', ['categories' => ProductCategory::all()]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pages.categories.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|min:2',
    ]);

    ProductCategory::create([
      'name' => $request->name,
    ]);

    return redirect(route('categories.index'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    return view('pages.categories.edit', ['category' => ProductCategory::findOrFail($id)]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|min:2',
    ]);

    $productCategory = ProductCategory::findOrFail($id);

    $productCategory->update([
      'name' => $request->name,
    ]);

    return redirect(route('categories.index'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $productCategory = ProductCategory::findOrFail($id);

    $productCategory->delete();

    return redirect(route('categories.index'));
  }
}
