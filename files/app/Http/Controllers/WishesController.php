<?php

namespace App\Http\Controllers;

use App\Brandcategory;
use App\Category;
use App\Wish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class WishesController extends Controller
{
    protected $categories;
    protected $brandss;


    public function __construct()
    {
        $this->categories = Category::get();
        $this->brandss = Brandcategory::get();
    }

    public function index()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        if(Auth::check())
        {
            $wishProducts = Wish::where('user_id', Auth::user()->id)->latest()->paginate(5);
        } else {
            $wishProducts = Wish::where('ip_address', request()->getClientIp())->latest()->paginate(5);
        }

        return view('pages.wish', compact('categories', 'brandss', 'wishProducts', 'wishCount'));
    }

    public function store(Request $request)
    {
        if(Auth::check())
        {
            if(Wish::where('product_id', Input::get('id'))->where('user_id', Auth::user()->id)->exists())
            {
                return back()->with('message', 'Ваш товар уже был сохранен');
            }
        } else {
            if(Wish::where('product_id', Input::get('id'))->where('ip_address', request()->getClientIp())->exists())
            {
                return back()->with('message', 'Ваш товар уже был сохранен');
            }
        }

        if(Auth::check())
        {
            Wish::create([
                'product_id' => $request->id,
                'user_id' => Auth::user()->id,
            ]);
        } else {
            Wish::create([
                'product_id' => $request->id,
                'ip_address' => request()->getClientIp(),
            ]);
        }

        return back()->with('message', 'Ваш товар успешно сохранен');
    }

    public function delete(Wish $id)
    {
        $id->delete();
        return back()->with('message', 'Ваш товар успешно удален');
    }
}
