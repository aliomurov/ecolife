<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Wish;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $categories;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->categories = Category::get();
    }

    public function showResetForm(Request $request, $token = null)
    {
        $categories = $this->categories;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('auth.passwords.reset', compact('categories', 'wishCount'))->with(
            [
                'token' => $token,
                'email' => $request->email
            ]
        );
    }
}
