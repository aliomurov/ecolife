<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Brandcategory;
use App\Category;
use App\Wish;
use Illuminate\Support\Facades\Auth;

class NavsController extends Controller
{
    protected $categories;
    protected $brandss;
    protected $paginate;

    public function __construct()
    {
        $this->categories = Category::get();
        $this->brandss = Brandcategory::get();
        $this->paginate = 15;
    }

    public function about()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('menu.about', compact('categories', 'brandss', 'wishCount'));
    }

    public function delivery()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('menu.delivery', compact('categories', 'brandss', 'wishCount'));
    }

    public function payment()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('menu.payment', compact('categories', 'brandss', 'wishCount'));
    }

    public function contact()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('menu.contact', compact('categories', 'wishCount', 'brandss'));
    }

    public function gallery()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('menu.gallery', compact('categories', 'brandss', 'wishCount'));
    }

    public function ecoBlog()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;
        $paginate = $this->paginate;

        $blogs = Blog::latest()->paginate($paginate);

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('menu.eco-blog', compact('categories', 'brandss', 'wishCount', 'blogs'));
    }
}