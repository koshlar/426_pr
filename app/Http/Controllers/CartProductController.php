<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
  public function index()
  {
    return view('pages.cart.index', ['products' => CartProduct::where('user_id', auth()->user()->id)->get()]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'product_id' => 'required|string|exists:products,id',
    ]);

    CartProduct::create([
      'user_id' => auth()->user()->id,
      'product_id' => $request->product_id,
      'count' => 1,
    ]);

    return redirect()->back();
  }

  public function add(Request $request)
  {
    $request->validate([
      'product_id' => 'required|string|exists:products,id',
    ]);

    $cartProduct = CartProduct::where('user_id', auth()->user()->id)
      ->where('product_id', $request->product_id)
      ->first();

    $cartProduct->increment('count');

    return redirect()->back();
  }

  public function remove(Request $request)
  {
    $request->validate([
      'product_id' => 'required|string|exists:products,id',
    ]);

    $cartProduct = CartProduct::where('user_id', auth()->user()->id)
      ->where('product_id', $request->product_id)
      ->first();

    if ($cartProduct->count < 2) {
      $cartProduct->delete();
    } else {
      $cartProduct->decrement('count');
    }

    return redirect()->back();
  }
}
