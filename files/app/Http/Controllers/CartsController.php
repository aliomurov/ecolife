<?php

namespace App\Http\Controllers;

use App\Brandcategory;
use App\Category;
use App\Wish;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartsController extends Controller
{
    protected $categories;
    protected $brandss;

    public function __construct()
    {
        $this->categories = Category::get();
        $this->brandss = Brandcategory::get();
    }

    public function index()
    {
        $categories = $this->categories;
        $brandss = $this->brandss;

        if(Auth::check())
        {
            $wishCount = Wish::where('user_id', Auth::user()->id)->count();
        } else {
            $wishCount = Wish::where('ip_address', request()->getClientIp())->count();
        }

        return view('pages.cart', compact('categories', 'brandss', 'wishCount'));
    }

    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request)
        {
            return $cartItem->id === $request->id;
        });

        if($duplicates->isNotEmpty())
        {
            return back()->with('message', 'товар уже есть в вашей корзине');
        }

        Cart::add($request->id, $request->name, 1, $request->old_price ? $request->old_price : $request->price)
        ->associate('App\Product');

        return back()->with('message', 'Ваш товар успешно добавлен в корзину');
    }

    public function empty()
    {
        Cart::destroy();
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('message', 'Товар удален из корзины');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,30'
        ]);

        if($validator->fails()){
            session()->flash('message', collect(['Выберите количество товара от 1 до 30']));
            return response()->json(['success' => false], 400);
        }

        Cart::update($id, $request->quantity);
        session()->flash('message', 'Корзина обновлен');
        return response()->json(['success' => true]);
    }

}
