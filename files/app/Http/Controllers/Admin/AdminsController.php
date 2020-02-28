<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Comment;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class AdminsController extends Controller
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

        $admins = Admin::paginate($paginate);

        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.admins.index',
            compact('admins', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function create()
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;

        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.admins.create',
            compact('comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'sometimes|nullable|string|min:4|confirmed',
        ]);

        if (Admin::where('email', '=', Input::get('email'))->exists())
        {
            return back()->with('danger', 'Администратор с таким email уже существует!');
        }

        Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        return redirect()->route('admin-list.index')->with('status', 'Успешно добавлен!');
    }


    public function edit(Admin $id)
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.admins.edit',
            compact('id', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function update(Request $request, Admin $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,'.auth()->guard('admin')->id(),
            'password' => 'sometimes|nullable|string|min:4|confirmed',
        ]);

        $id->name = $request['name'];
        $id->email = $request['email'];

        if ($request['password'])
        {
            $id->password = bcrypt($request['password']);
        }

        $id->save();

        return redirect()->route('admin-list.index')->with('status', 'Успешно изменен!');
    }

    public function delete(Admin $id)
    {
        $id->delete();
        return redirect()->route('admin-list.index')->with('danger', 'Успешно удален!');
    }


    public function userIndex()
    {
        $paginate = $this->paginate;

        $users = User::paginate($paginate);

        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.users.index',
            compact('users', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function userDelete(User $id)
    {
        $id->delete();
        return redirect()->route('user.index')->with('danger', 'Успешно удален!');
    }


}
