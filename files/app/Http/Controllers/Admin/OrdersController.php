<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
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
        $paginate = $this->paginate;
        $orders = Order::orderBy('shipped')->paginate($paginate);
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.orders.index',
            compact('orders', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function edit(Order $id)
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        $products = $id->products;
        return view('admin.orders.edit',
            compact('id', 'products', 'comments_view_count', 'orders_shipped_count','comment_view', 'orders_shipped'));
    }

    public function update(Request $request, Order $id)
    {
        $id->shipped = $request['shipped'];
        $id->save();
        return redirect()->route('order.index')->with('status', 'Успешно изменен!');
    }

    public function delete(Order $id)
    {
        $id->delete();
        return redirect()->route('order.index')->with('danger', 'Успешно удален!');
    }
}
