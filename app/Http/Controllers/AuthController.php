<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Http\Resources\UserResource;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
  public function updateOrCreateUser(UserPostRequest $request)
  {
    try {
      DB::beginTransaction();

      $fields = $request->validated();

      $user = User::updateOrCreate(
        ['id' => $request->id],
        $fields + ['password' => Hash::make($request->password)]
      );

      DB::commit();
      return (new UserResource($user))->response()->setStatusCode(201);
    } catch (\Throwable $th) {
      throw $th;
      DB::rollBack();
      return response(null, Response::HTTP_NOT_IMPLEMENTED);
    }
  }

  function register(Request $request)
  {

    $credentials = $request->only('email', 'password');

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

    $log = ['user' => auth()->user()->email, 'action' => 'Logged In', 'description' => 'User has logged in successfully.'];
    Log::create($log);

    return response()->json(Auth::user(), 201);
  }

  function logout(Request $request)
  {
    auth()->guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    $log = ['user' => auth()->user()->email, 'action' => 'Logged Out', 'description' => 'User has logged out successfully.'];
    Log::create($log);
    return response()->json(null, 200);
  }
}
