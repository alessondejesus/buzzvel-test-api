<?php

namespace App\Http\Controllers;

use App\Service\ResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private readonly ResponseService $responseService)
    {
    }

    public function login(Request $request)
    {
        return $this->responseService->handle(function () use ($request) {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (!Auth::attempt($credentials)) {
                throw new Exception('The provided credentials are incorrect.', 422);
            }

            $user = Auth::user();

            $user->access_token = $user->createToken($request->getClientIp())->plainTextToken;

            return $user;
        });
    }

    public function logout(Request $request)
    {
        return $this->responseService->handle(fn() => $request->user()->tokens()->delete());
    }
}
