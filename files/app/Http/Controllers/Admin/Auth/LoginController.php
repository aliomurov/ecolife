<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Brand;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    protected $categories;
    protected $brandss;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->categories = Category::get();
        $this->brandss = Brand::get();
    }

    public function showLoginForm()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        return view('admin.auth.login', compact('categories', 'brandss'));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
           'email' => 'required',
           'password' => 'required'
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            return redirect()->intended(route('admin.index'));
        }

        $errors = new MessageBag(['password' => 'Логин или пароль неверный']);

        return redirect()->back()->withInput($request->all())->withErrors($errors);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
