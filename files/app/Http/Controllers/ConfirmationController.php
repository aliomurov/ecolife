<?php

namespace App\Http\Controllers;

use App\Brandcategory;
use App\Category;
use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmationController extends Controller
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

        if(! session()->has('status'))
        {
            return redirect('');
        }

        return view('pages.thanks', compact('categories', 'brandss', 'wishCount'));
    }
}
