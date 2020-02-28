<?php

namespace App\Http\Controllers;

use App\Brandcategory;
use App\Category;
use App\Order;
use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    protected $categories;
    protected $brandss;

    public  function __construct()
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

        $orders = auth()->user()->orders;

        return view('pages.showOrder', compact('wishCount', 'categories', 'orders', 'brandss'));
    }

    public function show(Order $id)
    {
        $products = $id->products;
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('pages.order', compact('id', 'products', 'wishCount', 'categories', 'brandss'));
    }
}
