<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function authenticate(Request $request)
    {
        // Define custom error messages
        $messages = [
            'required' => ':Attribute harus diisi.',
            'nik.required' => 'NIK harus diisi.',
            'nik.exists' => 'NIK tidak terdaftar.',
            'password.required' => 'Kata sandi harus diisi.',
            'password.exists' => 'Kata sandi tidak cocok.',
        ];

        // Create a validator instance with custom error messages
        $validator = Validator::make($request->all(), [
            'nik' => 'required|exists:users,nik',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Attempt authentication
        if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        // Authentication failed
        return back()->withErrors([
            'password' => 'Kata sandi tidak cocok.',
        ])->withInput(['nik' => $request->nik]);
    }
}
