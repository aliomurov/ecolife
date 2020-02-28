<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    protected $orders_shipped_count;
    protected $comments_view_count;
    protected $comment_view;
    protected $orders_shipped;
    protected $paginate;

    public function __construct()
    {
        $this->orders_shipped_count = Order::where('shipped', false)->count();
        $this->comments_view_count = Comment::where('view', false)->count();
        $this->orders_shipped = Order::where('shipped', false)->latest()->take(5)->get();
        $this->comment_view = Comment::where('view', false)->latest()->take(5)->get();
        $this->paginate = 10;
    }

    public function index()
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;
        $paginate = $this->paginate;

        $orders_count = Order::count();
        $product_count = Product::count();
        $users_count = User::count();
        $comments_count = Comment::count();

        $orders = Order::where('shipped', false)->latest()->paginate($paginate);

        return view('admin.pages.index',
            compact('orders', 'orders_count', 'product_count', 'users_count', 'comments_count',
                'orders_shipped_count', 'comments_view_count', 'comment_view', 'orders_shipped'));
    }
}
