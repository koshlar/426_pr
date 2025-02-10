<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegLogController extends Controller
{
  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pages.auth.register');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|min:2',
      'surname' => 'required|string|min:2',
      'patronymic' => 'required|string|min:2',
      'email' => 'required|string|email|unique:users,email',
      'phone' => 'required|string|between:11,12|unique:users,phone',
      'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
      'name' => $request->name,
      'surname' => $request->surname,
      'patronymic' => $request->patronymic,
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => bcrypt($request->password),
      'role_id' => 2,
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
   * Show the form for editing the specified resource.
   */
  public function edit()
  {
    return view('pages.auth.login');
  }

  /**
   * Update the specified resource in storage.
   */
  public function login(Request $request)
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
  public function logout()
  {
    Auth::logout();
    return redirect('/');
  }
}
