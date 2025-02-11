<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  public function index()
  {
    return view('pages.products.index');
  }

  public function show($id)
  {
    return view('pages.products.show');
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
      $image = $request->file('image');
      $filename = uniqid() . $image->extension();

      if (Storage::disk('public')->exists('images/products'))
        Storage::disk('public')->makeDirectory('images/products');

      Storage::disk('public')->put('images/products/' . $filename, file_get_contents($image));
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
    return view('pages.products.edit');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'email' => 'required|string|email|exists:users,email',
      'password' => 'required|string',
    ]);

    $credentials = $request->only(['email', 'password']);

    if (Auth::attempt($credentials, true)) {
      $request->session()->regenerate();
      return redirect('/');
    }
    return redirect()
      ->back()
      ->withInput()
      ->withErrors(['email' => 'Invalid credentials.']);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    Auth::logout();
    return redirect('/');
  }
}
