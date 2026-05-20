<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{

    public function showLogin(){
        return view('auth.login');
    }
    
    public function login(Request $request){
        $credentials = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials['phone'] = str_replace(" ", "", $credentials['phone']); 
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if (!$user->status) {
                Auth::logout();
                return back()->withErrors(['phone' => 'Sizning profilingiz bloklangan!']);
            }
            $allowedRoles = ['admin', 'drektor', 'operator'];
            if (!in_array($user->type, $allowedRoles)) {
                Auth::logout();
                return back()->withErrors(['phone' => 'Sizga ushbu tizimga kirishga ruxsat berilmagan!']);
            }
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'phone' => 'Kiritilgan telefon raqami yoki parol noto\'g\'ri.',
        ])->onlyInput('phone');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
