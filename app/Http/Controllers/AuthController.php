<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	function register(Request $request)
	{

		$credentials = $request->only('username', 'password');

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			return response('Login Success', 200);
		}

		return response('Unauthorized', 401);
	}

	function login(Request $request)
	{
		$credentials = $request->only('email', 'password');

		if (!auth()->attempt($credentials)) {
			throw ValidationException::withMessages([
				'email' => 'Invalid credentials'
			]);
		}

		$request->session()->regenerate();

		return response()->json(Auth::user(), 201);
	}

	function logout(Request $request)
	{
		auth()->guard('web')->logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return response()->json(null, 200);
	}
}
