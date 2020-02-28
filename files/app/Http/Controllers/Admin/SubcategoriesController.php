<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Order;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SubcategoriesController extends Controller
{
    protected $categories;
    protected $categoriess;
    protected $paginate;
    protected $orders_shipped_count;
    protected $comments_view_count;
    protected $comment_view;
    protected $orders_shipped;

    public function __construct()
    {
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->categoriess = Category::get();
        $this->paginate = 10;
        $this->orders_shipped_count = Order::where('shipped', false)->count();
        $this->comments_view_count = Comment::where('view', false)->count();
        $this->orders_shipped = Order::where('shipped', false)->latest()->take(5)->get();
        $this->comment_view = Comment::where('view', false)->latest()->take(5)->get();
    }

    public function index()
    {
        $categoriess = $this->categoriess;
        $paginate = $this->paginate;
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        if(request()->category) {
            $subcategories = Subcategory::with('category')->whereHas('category', function($query)
            {
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categoriess->where('slug', request()->category)->first())->name;
            $subcategories = $subcategories->paginate($paginate);
        } else {
            $subcategories = Subcategory::paginate($paginate);
            $categoryName = 'Под категории';
        }

        return view('admin.subcategories.index',
            compact('subcategories', 'categoryName', 'categoriess', 'comments_view_count',
                'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function create()
    {
        $categories = $this->categories;
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.subcategories.create',
            compact('categories', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required'
        ]);

        if (Subcategory::where('name', '=', Input::get('name'))->exists())
        {
            return back()->with('danger', 'Такое имя уже существует!');
        }

        Subcategory::create([
            'name' => $request['name'],
            'category_id' => $request['category_id']
        ]);

        return redirect()->route('subcategory.index')->with('status', 'Успешно добавлен!');
    }


    public function edit(Subcategory $subcategory)
    {
        $categories = $this->categories;
        $categoriess = $this->categoriess;
        $paginate = $this->paginate;

        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        if(request()->category) {
            $subcategories = Subcategory::with('category')->whereHas('category', function($query)
            {
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categoriess->where('slug', request()->category)->first())->name;
            $subcategories = $subcategories->paginate($paginate);
        } else {
            $subcategories = Subcategory::paginate($paginate);
            $categoryName = 'Под категории';
        }

        return view('admin.subcategories.edit',
            compact('subcategory','categories', 'categoryName', 'subcategories', 'categoriess',
            'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required'
        ]);

        $subcategory->name = $request['name'];
        $subcategory->category_id = $request['category_id'];
        $subcategory->save();

        return redirect()->route('subcategory.index')->with('status', 'Успешно изменен!');
    }

    public function delete(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategory.index')->with('danger', 'Успешно удален!');
    }
}
