<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserAdminController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $adminToken = env('ADMIN_API_TOKEN');
        $providedToken = $request->header('X-Admin-Token');

        if (!$adminToken || $providedToken !== $adminToken) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $validated = $request->validate([
            'login' => ['required', 'string', 'max:255', Rule::unique('users', 'login')],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:6'],
            'credit_ia' => ['nullable', 'integer', 'min:0'],
            'msisdn' => ['nullable', 'string', 'max:32'],
            'subscription_id' => ['nullable', 'string', 'max:255'],
            'subscribed' => ['nullable', 'boolean'],
        ]);

        $user = new User();
        $user->login = $validated['login'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->credit_ia = $validated['credit_ia'] ?? 0;
        $user->msisdn = $validated['msisdn'] ?? null;
        $user->subscription_id = $validated['subscription_id'] ?? null;
        $user->subscribed = (bool) ($validated['subscribed'] ?? false);
        $user->save();

        return response()->json([
            'message' => 'User created',
            'data' => [
                'id' => $user->id,
                'login' => $user->login,
                'email' => $user->email,
                'credit_ia' => $user->credit_ia,
                'subscribed' => $user->subscribed,
                'created_at' => $user->created_at,
            ],
        ], 201);
    }
}
