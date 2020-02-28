<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Comment;
use App\Helpers\Image;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
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

        $blogs = Blog::paginate($paginate);

        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.blogs.index',
            compact('blogs', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function create()
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;

        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.blogs.create',
            compact('comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image',
            'description' => 'required'
        ]);

        if (Blog::where('name', '=', Input::get('name'))->exists())
        {
            return back()->with('danger', 'Такой блок уже существует!');
        }

        $image = Image::store('blogs', $request->file('image'));

        Blog::create([
            'name' => $request['name'],
            'image' => $image,
            'description' => $request['description']
        ]);

        return redirect()->route('blog.index')->with('status', 'Успешно добавлен!');
    }


    public function edit(Blog $blog)
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.blogs.edit',
            compact('blog', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image',
            'description' => 'required'
        ]);

        if ($request['image'])
        {
            Storage::delete($blog->image);
            $image = Image::store('blogs', $request->file('image'));
        }

        $blog->name = $request['name'];
        $blog->description = $request['description'];
        if ($request['image'])
        {
            $blog->image = $image;
        }
        $blog->save();

        return redirect()->route('blog.index')->with('status', 'Успешно изменен!');
    }

    public function delete(Blog $blog)
    {
        Storage::delete($blog->image);
        $blog->delete();
        return redirect()->route('blog.index')->with('danger', 'Успешно удален!');
    }
}
