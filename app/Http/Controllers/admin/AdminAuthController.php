<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('admin.dashboard'));
        } else {
            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->addError('Email / Password Salah.');
            return redirect(route('admin.login.index'));
        }
    }

    public function logout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect(route('admin.login.index'));
        }
    }
}
