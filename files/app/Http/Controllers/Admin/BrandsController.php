<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Brandcategory;
use App\Comment;
use App\Helpers\Image;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    protected $orders_shipped_count;
    protected $comments_view_count;
    protected $comment_view;
    protected $orders_shipped;
    protected $brandcategories;
    protected $paginate;

    public function __construct()
    {
        $this->orders_shipped_count = Order::where('shipped', false)->count();
        $this->comments_view_count = Comment::where('view', false)->count();
        $this->orders_shipped = Order::where('shipped', false)->latest()->take(5)->get();
        $this->comment_view = Comment::where('view', false)->latest()->take(5)->get();
        $this->brandcategories = Brandcategory::pluck('name', 'id')->toArray();
        $this->paginate = 10;
    }

    public function index()
    {
        $paginate = $this->paginate;
        $brands = Brand::paginate($paginate);
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.brands.index',
            compact('brands', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function create()
    {
        $brandcategories = $this->brandcategories;
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.brands.create',
            compact('comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped', 'brandcategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image',
            'brandcategory_id' => 'required'
        ]);

        if (Brand::where('name', '=', Input::get('name'))->exists())
        {
            return back()->with('danger', 'Такое имя уже существует!');
        }

        $image = Image::store('brands', $request->file('image'));

        Brand::create([
            'name' => $request['name'],
            'brandcategory_id' => $request['brandcategory_id'],
            'image' => $image
        ]);

        return redirect()->route('brand.index')->with('status', 'Успешно добавлен!');
    }


    public function edit(Brand $brand)
    {
        $brandcategories = $this->brandcategories;
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.brands.edit',
            compact('brand', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped', 'brandcategories'));
    }

    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image',
            'brandcategory_id' => 'required'
        ]);

        if ($request['image'])
        {
            Storage::delete($brand->image);
            $image = Image::store('brands', $request->file('image'));
        }

        $brand->name = $request['name'];
        $brand->brandcategory_id = $request['brandcategory_id'];
        if ($request['image'])
        {
            $brand->image = $image;
        }
        $brand->save();

        return redirect()->route('brand.index')->with('status', 'Успешно изменен!');
    }

    public function delete(Brand $brand)
    {
        Storage::delete($brand->image);
        $brand->delete();
        return redirect()->route('brand.index')->with('danger', 'Успешно удален!');
    }
}
