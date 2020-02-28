<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Categoryproduct;
use App\Comment;
use App\Order;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryproductsController extends Controller
{
    protected $subcategories;
    protected $subcategoriess;
    protected $categoriess;
    protected $categories;
    protected $paginate;
    protected $orders_shipped_count;
    protected $comments_view_count;
    protected $comment_view;
    protected $orders_shipped;

    public function __construct()
    {
        $this->orders_shipped_count = Order::where('shipped', false)->count();
        $this->comments_view_count = Comment::where('view', false)->count();
        $this->orders_shipped = Order::where('shipped', false)->latest()->take(5)->get();
        $this->comment_view = Comment::where('view', false)->latest()->take(5)->get();

        $this->subcategories = Subcategory::pluck('name', 'id')->toArray();
        $this->subcategoriess = Subcategory::get();
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->categoriess = Category::get();
        $this->paginate = 10;
    }

    public function index(Subcategory $subcategory)
    {
        $subcategoriess = $this->subcategoriess;
        $categoriess = $this->categoriess;
        $paginate = $this->paginate;

        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        if(request()->subcategory) {
            $categoryproducts = Categoryproduct::with('subcategory')->whereHas('subcategory', function($query)
            {
                $query->where('slug', request()->subcategory);
            });
            $subcategoryName = optional($subcategoriess->where('slug', request()->subcategory)->first())->name;
            $categoryproducts = $categoryproducts->paginate($paginate);
        } else {
            $categoryproducts = Categoryproduct::paginate($paginate);
            $subcategoryName = '';
        }

        return view('admin.categoryproducts.index',
            compact('categoryproducts', 'subcategoriess', 'subcategoryName', 'categoriess', 'subcategory',
            'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function create()
    {
        $categories = $this->categories;
        $subcategories = $this->subcategories;

        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;

        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.categoryproducts.create',
            compact('categories', 'subcategories', 'comments_view_count', 'orders_shipped_count',
            'comment_view', 'orders_shipped'));
    }

    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $subcategories = Subcategory::where('category_id', '=', $request->category_id)->pluck("name","id")->all();
            $data = view('admin.include.ajax-select',compact('subcategories'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'subcategory_id' => 'required',
            'category_id' => 'required'
        ]);

        if (Categoryproduct::where('name', '=', Input::get('name'))->exists())
        {
            return back()->with('danger', 'Такое имя уже существует!');
        }

        Categoryproduct::create([
            'name' => $request['name'],
            'subcategory_id' => $request['subcategory_id'],
            'category_id' => $request['category_id']
        ]);

        return redirect()->route('categoryproduct.index')->with('status', 'Успешно добавлен!');
    }

    public function edit(Categoryproduct $categoryproduct)
    {
        $categories = $this->categories;
        $subcategories = $this->subcategories;

        $subcategoriess = $this->subcategoriess;
        $categoriess = $this->categoriess;
        $paginate = $this->paginate;

        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;

        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        if(request()->subcategory) {
            $categoryproducts = Categoryproduct::with('subcategory')->whereHas('subcategory', function($query)
            {
                $query->where('slug', request()->subcategory);
            });
            $subcategoryName = optional($subcategoriess->where('slug', request()->subcategory)->first())->name;
            $categoryproducts = $categoryproducts->paginate($paginate);
        } else {
            $categoryproducts = Categoryproduct::paginate($paginate);
            $subcategoryName = '';
        }

        return view('admin.categoryproducts.edit',
            compact('categoryproduct','categories', 'subcategories', 'categoriess', 'subcategoriess',
                'subcategoryName','categoryproducts', 'comments_view_count', 'orders_shipped_count', 'comment_view',
            'orders_shipped'));
    }

    public function update(Request $request, Categoryproduct $categoryproduct)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $categoryproduct->name = $request['name'];
        $categoryproduct->subcategory_id = $request['subcategory_id'];
        $categoryproduct->category_id = $request['category_id'];
        $categoryproduct->save();

        return redirect()->route('categoryproduct.index')->with('status', 'Успешно изменен!');
    }

    public function delete(Categoryproduct $categoryproduct)
    {
        $categoryproduct->delete();
        return redirect()->route('categoryproduct.index')->with('danger', 'Успешно удален!');
    }
}
