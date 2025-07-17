<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['sometimes', 'string', new Enum(UserRole::class)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? UserRole::USER->value, // Assign default role
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['status' => 'success', 'message' => 'Registration successful', 'data' => ['token' => $token, 'user' => $user]], 201);
    }

    /**
     * Log in an existing user.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['status' => 'error', 'message' => 'Invalid login credentials'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['status' => 'success', 'message' => 'Login successful', 'data' => ['token' => $token, 'user' => $user]]);
    }

    /**
     * Log out the current user and revoke their token.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['status' => 'success', 'message' => 'Logout successful']);
    }

    /**
     * Get the currently authenticated user.
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json(['status' => 'success', 'data' => $request->user()]);
    }
}
