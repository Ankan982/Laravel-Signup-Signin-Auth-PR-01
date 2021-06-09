<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\VerifyUser;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register()
    {

        return view('user.index');
    }

    public function login()
    {

        return view('user.login');
    }

    public function registerAction(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        try {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            $user_details = $this->userService->create($data);

            $verify_users_data = [
                'user_id' => $user_details->id,
                'token' => uniqid(),
            ];

            $this->userService->createVerifyToken($verify_users_data);

           $email_data = [
                'subject' => 'Email Verification Link',
                'name' => $user_details->name,
                'url' => route('user.email.verification', ['token' => $verify_users_data['token']]),
                'logopath' => '',
            ];
            Mail::to($user_details->email)->send(new VerifyEmail($email_data));
            Session::flash('message-success', 'User is created successfully.');
            return redirect()->route('user.home');

        } catch (Exception $e) {

          //  dd($e->getMessage());
           
            return redirect()->route('user.home');
            Session::flash('message-error', 'User is not created.');
        }
    }


    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'role' => ['user']])) {
                 
                Session::flash('message-success', 'User logged in successfully');
                return redirect()->route('user.profile');
            } else {
                Session::flash('message-error', 'User is not valid');
                return redirect()->back();
            }
        } catch (Exception $e) {
            Session::flash('message-error', 'Something went wrong');
            return redirect()->route('user.login');
        }
    }

    public function index()
    {
        $users = auth()->user();
        return view('user.userprofile',  compact('users'));
    }

    
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('user.login');
    }

    public function emailVerification(Request $request)
    {
        try {
            $response = $this->userService->emailVerification($request->token);
            if ($response == VerifyUser::RESPONSE_SUCCESS) {
                return redirect()->route('user.login')->with('message-success', 'Email has been verified successfully');
            } else if ($response == VerifyUser::RESPONSE_SUCCESS_AGAIN) {
                return redirect()->route('user.login')->with('message-success', 'You already verify your email address');
            } else {
                return redirect()->route('user.home')->with('message-error', 'Invalid Token');
            }
        } catch (\Exception $e) {
            return redirect()->route('user.home')->with('message-error', 'Something Went Wrong. Please try after some time');
        }
    }
}
