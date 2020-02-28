<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Order;
use App\Brandcategory;
use Illuminate\Support\Facades\Input;

class BrandcategoriesController extends Controller
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
        $brandcategories = Brandcategory::paginate($paginate);
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.brandcategories.index',
            compact('brandcategories', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function create()
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.brandcategories.create',
            compact('comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        if (Brandcategory::where('name', '=', Input::get('name'))->exists())
        {
            return back()->with('danger', 'Такое имя уже существует!');
        }

        Brandcategory::create([
            'name' => $request['name']
        ]);

        return redirect()->route('brandcategories.index')->with('status', 'Успешно добавлен!');
    }

    public function edit(Brandcategory $brandcategory)
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.brandcategories.edit',
            compact('brandcategory', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function update(Request $request, Brandcategory $brandcategory)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $brandcategory->name = $request['name'];
        $brandcategory->save();

        return redirect()->route('brandcategories.index')->with('status', 'Успешно изменен!');
    }

    public function delete(Brandcategory $brandcategory)
    {
        $brandcategory->delete();
        return redirect()->route('brandcategories.index')->with('danger', 'Успешно удален!');
    }
}
