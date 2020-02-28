<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Categoryproduct;
use App\Comment;
use App\Country;
use App\Exports\ProductsExport;
use App\Helpers\Image;
use App\Imports\ProductsImport;
use App\Order;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    protected $subcategories;
    protected $categories;
    protected $categoriess;
    protected $categoryproducts;
    protected $brands;
    protected $countries;
    protected $paginate;
    protected $orders_shipped_count;
    protected $comments_view_count;
    protected $comment_view;
    protected $orders_shipped;

    public function __construct()
    {
        $this->categoryproducts = Categoryproduct::pluck('name', 'id')->toArray();
        $this->subcategories = Subcategory::pluck('name', 'id')->toArray();
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->brands = Brand::pluck('name', 'id')->toArray();
        $this->countries = Country::pluck('name', 'id')->toArray();
        $this->categoriess = Category::get();
        $this->paginate = 10;
        $this->orders_shipped_count = Order::where('shipped', false)->count();
        $this->comments_view_count = Comment::where('view', false)->count();
        $this->orders_shipped = Order::where('shipped', false)->latest()->take(5)->get();
        $this->comment_view = Comment::where('view', false)->latest()->take(5)->get();
    }

    public function index()
    {
        $paginate = $this->paginate;
        $categoriess = $this->categoriess;
        $products = Product::paginate($paginate);
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.products.index',
            compact('products', 'categoriess','comments_view_count',
        'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new ProductsImport, $request->file('import_file'));
        return redirect()->route('product.index')->with('status', 'Успешно импортирован!');
    }

    public function showsubcat(Subcategory $subcategory)
    {
        $paginate = $this->paginate;
        $categoriess = $this->categoriess;

        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        $categoryproducts = Categoryproduct::where('subcategory_id', $subcategory->id)->get();

        if(request()->categoryproduct) {
            $subcatproducts = Product::with('categoryproduct')->whereHas('categoryproduct', function($query)
            {
                $query->where('slug', request()->categoryproduct);
            });
            $categoryProductName = optional($categoryproducts->where('slug', request()->categoryproduct)->first())->name;
            $subcatproducts = $subcatproducts->paginate($paginate);
        } else {
            $subcatproducts = Product::where('subcategory_id', $subcategory->id)->paginate($paginate);
            $categoryProductName = $subcategory->name;
        }

        return view('admin.products.showsubcat',
            compact('subcatproducts', 'categoriess', 'subcategory', 'categoryproducts',
                'categoryProductName', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function create(Category $category)
    {
        $categories = $this->categories;
        $subcategories = $this->subcategories;
        $categoryproducts = $this->categoryproducts;
        $brands = $this->brands;
        $countries = $this->countries;
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.products.create',
            compact('categories', 'subcategories', 'categoryproducts', 'brands', 'countries', 'category',
            'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $subcategories = Subcategory::where('category_id', '=', $request->category_id)->pluck("name","id")->all();
            $categoryproducts = Categoryproduct::where('subcategory_id', '=', $request->subcategory_id)->pluck("name","id")->all();
            $data = view('admin.include.ajax-select',compact('subcategories', 'categoryproducts'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image',
            'subcategory_id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'country_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'structure' => 'required',
            'preparation' => 'required',
            'gram' => 'required',
            'available' => 'required'
        ]);

        if (Product::where('name', '=', Input::get('name'))->exists())
        {
            return back()->with('danger', 'Такое имя уже существует!');
        }

        $image = Image::store('products', $request->file('image'));

        Product::create([
            'name' => $request['name'],
            'category_id' => $request['category_id'],
            'subcategory_id' => $request['subcategory_id'],
            'categoryproduct_id' => $request['categoryproduct_id'],
            'country_id' => $request['country_id'],
            'brand_id' => $request['brand_id'],
            'image' => $image,
            'kod' => 'ECO-'. rand(100, 999999),
            'description' => $request['description'],
            'structure' => $request['structure'],
            'preparation' => $request['preparation'],
            'price' => $request['price'],
            'gram' => $request['gram'],
            'new' => $request['new'],
            'sale' => $request['sale'],
            'old_price' => $request['old_price'],
            'available' => $request['available'],
        ]);

        return redirect()->route('product.index')->with('status', 'Успешно добавлен!');
    }

    public function edit(Product $product)
    {
        $categories = $this->categories;
        $subcategories = $this->subcategories;
        $categoryproducts = $this->categoryproducts;
        $brands = $this->brands;
        $countries = $this->countries;
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.products.edit',
            compact('product','categories', 'subcategories', 'categoryproducts', 'brands',
                'countries', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image',
            'subcategory_id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'structure' => 'required',
            'preparation' => 'required',
            'gram' => 'required',
            'country_id' => 'required',
            'available' => 'required'
        ]);

        if ($request['image'])
        {
            Storage::delete($product->image);
            $image = Image::store('products', $request->file('image'));
        }

        $product->name = $request['name'];
        $product->category_id = $request['category_id'];
        $product->subcategory_id = $request['subcategory_id'];
        $product->categoryproduct_id = $request['categoryproduct_id'];
        $product->brand_id = $request['brand_id'];
        $product->price = $request['price'];
        $product->description = $request['description'];
        $product->structure = $request['structure'];
        $product->preparation = $request['preparation'];
        $product->gram = $request['gram'];
        $product->new = $request['new'];
        $product->country_id = $request['country_id'];
        $product->sale = $request['sale'];
        $product->old_price = $request['old_price'];
        $product->available = $request['available'];

        if ($request['image'])
        {
            $product->image = $image;
        }
        $product->save();

        return redirect()->route('product.index')->with('status', 'Успешно изменен!');
    }

    public function delete(Product $product)
    {
        Storage::delete($product->image);
        $product->delete();
        return redirect()->route('product.index')->with('danger', 'Успешно удален!');
    }
}
