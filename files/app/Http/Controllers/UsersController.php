<?php

namespace App\Http\Controllers;

use App\Brandcategory;
use App\Category;
use App\Order;
use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    protected $categories;
    protected $brandss;

    public  function __construct()
    {
        $this->categories = Category::get();
        $this->brandss = Brandcategory::get();
    }

    public function edit()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('pages.user', compact('categories', 'brandss', 'wishCount'))->with('user', auth()->user());
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $input = $request->except('password', 'password_confirmation');

        if(!$request->filled('password'))
        {
            $user->fill($input)->save();
            return back()->with('message', 'Профиль успешно обновлен');
        }

        $user->password = bcrypt($request->password);
        $user->fill($input)->save();

        return back()->with('message', 'Профиль (и пароль) успешно обновлен');
    }
}
