<?php

namespace App\Http\Controllers\Auth;

use App\Brandcategory;
use App\Category;
use App\Wish;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $categories;
    protected $brandss;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->categories = Category::get();
        $this->brandss = Brandcategory::get();
    }

    public function showLoginForm()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        session()->put('previousUrl', url()->previous());

        return view('auth.login', compact('categories', 'brandss', 'wishCount'));
    }

    public function redirectTo()
    {
        return str_replace(url('/'), '', session()->get('previousUrl', '/'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('pages.index');
    }

}
