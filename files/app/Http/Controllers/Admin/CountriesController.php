<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Country;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CountriesController extends Controller
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

        $countries = Country::paginate($paginate);
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.countries.index',
            compact('countries', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function create()
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.countries.create',
            compact('comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        if (Country::where('name', '=', Input::get('name'))->exists())
        {
            return back()->with('danger', 'Такое имя уже существует!');
        }

        Country::create([
            'name' => $request['name']
        ]);

        return redirect()->route('country.index')->with('status', 'Успешно добавлен!');
    }

    public function edit(Country $country)
    {
        $comments_view_count = $this->comments_view_count;
        $orders_shipped_count = $this->orders_shipped_count;
        $orders_shipped = $this->orders_shipped;
        $comment_view = $this->comment_view;

        return view('admin.countries.edit',
            compact('country', 'comments_view_count', 'orders_shipped_count', 'comment_view', 'orders_shipped'));
    }

    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $country->name = $request['name'];
        $country->save();

        return redirect()->route('country.index')->with('status', 'Успешно изменен!');
    }

    public function delete(Country $country)
    {
        $country->delete();
        return redirect()->route('country.index')->with('danger', 'Успешно удален!');
    }
}
