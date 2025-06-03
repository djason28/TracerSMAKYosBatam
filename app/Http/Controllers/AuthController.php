<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client; 

class AuthController extends Controller
{
    /**
     * Register a new user (admin or alumni)
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:admin,alumni',
        ]);

        $email = strtolower($data['email']);

        try {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $email,
                'password' => Hash::make($data['password']),
                'role'     => $data['role'],
            ]);

            return response()->json([
                'status' => 'success',
                'data'   => $user
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal mendaftarkan pengguna'
            ], 500);
        }
    }


    /**
     * Login and issue token
     */
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string', // bisa berupa email atau NISN
            'password' => 'required|string',
        ]);

        $loginInput = strtolower($request->login); // normalisasi input login
        $password   = $request->password;

        // Cek apakah input adalah email (admin) atau NISN (alumni)
        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            // Login sebagai admin
            $credentials = [
                'email'    => $loginInput,
                'password' => $password,
                'role'     => 'admin',
            ];
        } else {
            // Login sebagai alumni
            $credentials = [
                'nis'     => $loginInput,
                'password' => $password,
                'role'     => 'alumni',
            ];
        }

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Email/NISN atau password salah.',
            ], 401);
        }

        $user  = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'       => 'success',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
        ]);
    }


    public function webLogin(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admindb_admin');
        } elseif ($user->role === 'alumni') {
            return redirect()->route('alumni', ['id' => $user->id]);
        }

        // Optional: handle other roles
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}

    /**
     * Logout user (revoke current token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Berhasil logout'
        ]);
    }

   /**
     * Kirim email berisi link reset password
     */
    public function forgotPassword(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email' => 'required|email',
        ]);

        // 2. Kirim reset link via Password Broker
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // 3. Tanggapi hasil
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'status'  => 'success',
                'message' => __($status),
            ], 200);
        }

        return response()->json([
            'status'  => 'error',
            'message' => __($status),
        ], 400);
    }

    /**
     * Terima token + email + password baru, lalu reset
     */
    public function resetPassword(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'token'                 => 'required|string',
            'email'                 => 'required|email',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        // 2. Proses reset lewat Password Broker
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $newPassword) {
                // Update password + remember_token
                $user->forceFill([
                    'password'       => Hash::make($newPassword),
                    'remember_token' => Str::random(60),
                ])->save();

                // Event optional: broadcast bahwa password sudah direset
                event(new PasswordReset($user));
            }
        );

        // 3. Tanggapi hasil
        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'status'  => 'success',
                'message' => __($status),
            ], 200);
        }

        return response()->json([
            'status'  => 'error',
            'message' => __($status),
        ], 400);
    }
    }

