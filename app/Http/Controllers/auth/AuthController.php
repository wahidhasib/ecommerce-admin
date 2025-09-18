<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Undocumented function
     *
     * @param RegisterRequest $request
     * @return void
     */

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            Auth::login($user);

            return redirect()->route('home')->with(['success' => 'Account Created Successfully']);
        } catch (\Exception $e) {
            Log::error("Error: " . $e->getMessage());

            return redirect()->back()->with(['error' => 'Something went wrong!']);
        }
    }

    public function loginData(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $authRole = Auth::user()->role;

            switch ($authRole) {
                case "admin":
                    return redirect()->route('admin.dashboard');
                    break;
                default:
                    return redirect()->route('home');
                    break;
            }
        }

        return redirect()->route('login')->with(['error' => 'Invalid Credentials!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with(['success' => 'Logged Out Successfully!']);
    }
}
