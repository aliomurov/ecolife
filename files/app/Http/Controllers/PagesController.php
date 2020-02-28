<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Brand;
use App\Brandcategory;
use App\Category;
use App\Categoryproduct;
use App\Comment;
use App\Product;
use App\Slider;
use App\Subcategory;
use App\Events\PostHasViewed;
use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use willvincent\Rateable\Rating;

class PagesController extends Controller
{
    protected $categories;
    protected $categoryproducts;
    protected $brands;
    protected $brandss;
    protected $paginate;

    public function __construct()
    {
        $this->categories = Category::get();
        $this->categoryproducts = Categoryproduct::get();
        $this->brands = Brand::get();
        $this->brandss = Brandcategory::get();
        $this->paginate = 15;
    }

    public function index()
    {
        $products = Product::take(5)->inRandomOrder()->get();
        $blogs = Blog::latest()->take(3)->get();
        $categories = $this->categories;
        $brandss = $this->brandss;
        $sliders = Slider::take(3)->get();

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        $products_new = Product::where('new', true)->take(5)->latest()->get();
        $products_sale = Product::orderBy('views')->take(5)->latest()->get();

        return view('pages.index',
            compact('categories', 'products', 'blogs', 'products_new', 'products_sale', 'brandss',
                'wishCount', 'sliders'));
    }

    public function category(Category $category)
    {
        $categories = $this->categories;
        $brands = $this->brands;
        $brandss = $this->brandss;
        $paginate = $this->paginate;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        if(request()->brand) {
            $category_products = Product::where('category_id', $category->id)->with('brand')->whereHas('brand', function($query)
            {
                $query->where('slug', request()->brand);
            });
            $productName = optional($brands->where('slug', request()->brand)->first())->name;
            $category_products = $category_products->paginate($paginate);
        } else {
            $category_products = Product::where('category_id', $category->id)->latest()->paginate($paginate);
            $productName = $category->name;
        }

        return view('pages.category', compact('category', 'categories', 'category_products', 'brands', 'productName', 'brandss', 'wishCount'));
    }

    public function subcategory(Category $category, Subcategory $subcategory)
    {
        $categories = $this->categories;
        $brands = $this->brands;
        $brandss = $this->brandss;
        $paginate = $this->paginate;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        if(request()->brand) {
            $subcategory_products = Product::where('subcategory_id', $subcategory->id)->with('brand')->whereHas('brand', function($query)
            {
                $query->where('slug', request()->brand);
            });
            $productName = optional($brands->where('slug', request()->brand)->first())->name;
            $subcategory_products = $subcategory_products->paginate($paginate);
        } else {
            $subcategory_products = Product::where('subcategory_id', $subcategory->id)->latest()->paginate($paginate);
            $productName = $subcategory->name;
        }

        return view('pages.subcategory',
            compact('subcategory', 'subcategory_products', 'category', 'categories', 'productName', 'brands', 'brandss', 'wishCount'));
    }

    public function categoryproduct(Category $category, Subcategory $subcategory, Categoryproduct $categoryproduct)
    {
        $categories = $this->categories;
        $brands = $this->brands;
        $brandss = $this->brandss;
        $paginate = $this->paginate;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        if(request()->brand) {
            $category_products = Product::where('categoryproduct_id', $categoryproduct->id)->with('brand')->whereHas('brand', function($query)
            {
                $query->where('slug', request()->brand);
            });
            $productName = optional($brands->where('slug', request()->brand)->first())->name;
            $category_products = $category_products->paginate($paginate);
        } else {
            $category_products = Product::where('categoryproduct_id', $categoryproduct->id)->latest()->paginate($paginate);
            $productName = $categoryproduct->name;
        }

        return view('pages.categoryproduct',
            compact('categoryproduct', 'category_products', 'category', 'subcategory', 'categories', 'productName', 'brands', 'brandss', 'wishCount'));
    }

    public function product(Category $category, Subcategory $subcategory, Categoryproduct $categoryproduct, Product $product)
    {
        $products = Product::where('categoryproduct_id', '=', $product->categoryproduct->id)->take(4)->inRandomOrder()->get();
        $categories = $this->categories;
        $brandss = $this->brandss;
        $blogs = Blog::latest()->take(5)->get();
        $comments = Comment::where('product_id', '=', $product->id)->where('view', true)->latest()->get();

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        event(new PostHasViewed($product));

        return view('pages.product',
            compact('product', 'categories', 'category', 'products', 'blogs', 'comments', 'subcategory', 'brandss', 'wishCount', 'categoryproduct'));
    }

    public function rating(Request $request)
    {
        request()->validate(['rate' => 'required']);
        $product = Product::find($request->id);
        $rating = new Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user() ? auth()->user()->id : null;
        $product->ratings()->save($rating);

        return redirect()->back()->with('message', 'Спасибо ваш голос принят!');
    }

    public function blog(Blog $blog)
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        $blogs = Blog::latest()->take(5)->get();

        return view('pages.blog', compact('blog', 'categories', 'blogs', 'brandss', 'wishCount'));
    }

    public function brands()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;
        $paginate = $this->paginate;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }
        $brandscategory = Brandcategory::get();
        $brands = Brand::latest()->paginate($paginate);
        return view('pages.brands', compact('brandscategory','brands', 'categories', 'brandss', 'wishCount'));
    }

    public function brandcategory(Brandcategory $brandcategory, Brand $brand)
    {
        $categories = $this->categories;
        $brandss = $this->brandss;
        $paginate = $this->paginate;
        $brandscategory = Brandcategory::get();

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        $brands = Brand::where('brandcategory_id', $brandcategory->id)->latest()->paginate($paginate);
        return view('pages.brandscategory', compact('brands', 'brandcategory', 'brand', 'brandss', 'categories', 'wishCount', 'brandscategory'));
    }

    public function brand(Brandcategory $brandcategory, Brand $brand)
    {
        $categories = $this->categories;
        $brandss = $this->brandss;
        $paginate = $this->paginate;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        $brand_products = Product::where('brand_id', $brand->id)->latest()->paginate($paginate);
        return view('pages.brand', compact('brand', 'categories', 'brandcategory', 'brand_products', 'brandss', 'wishCount'));
    }

    public function search(Request $request)
    {
        $categories = $this->categories;
        $brandss = $this->brandss;
        $paginate = $this->paginate;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('structure', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('kod', 'like', "%$query%")
            ->orWhere('price', 'like', "%$query%")
            ->paginate($paginate);

        return view('pages.search', compact('categories', 'wishCount', 'products', 'brandss'));
    }

    public function news()
    {
        $paginate = $this->paginate;
        $categories = $this->categories;
        $brandss = $this->brandss;
        $news_products = Product::where('new', true)->latest()->paginate($paginate);

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('pages.news', compact('categories', 'news_products', 'brandss', 'wishCount'));
    }
}


