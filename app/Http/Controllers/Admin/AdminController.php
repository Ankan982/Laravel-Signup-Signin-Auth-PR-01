<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function login()
    {
        $title = ' Admin';
        return view('admin.index', compact('title'));
    }


    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required| email',
            'password' => 'required ',
        ]);

        try {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'role' => ['admin']])) {
                return redirect()->route('admin.profile')->with('message-success', 'You have logged in');
            } else {
                return redirect()->route('admin.login')->with('message-error', 'Email id or password incorrect')->withInput();
            }
        } catch (Exception $e) {
            return redirect()->route('admin.login')->with('message-error', 'Something Went Wrong. Please try after some time');
        }
    }

    public function index()
    {
        return view('admin.dashboard');
    }


    public function userlist()
    {
        $admin_users = $this->userService->findAll([
            ['role', '=', 'user'],
        ]);

        return view('admin.userlist',  compact('admin_users'));
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('admin.login');
    }
}
