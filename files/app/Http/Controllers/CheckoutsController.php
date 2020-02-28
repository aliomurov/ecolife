<?php

namespace App\Http\Controllers;

use App\Brandcategory;
use App\Category;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderPlaced;
use App\Order;
use App\OrderProduct;
use App\Wish;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutsController extends Controller
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

        if(Cart::instance('default')->count() == 0)
        {
            return redirect()->route('pages.index');
        }

        return view('pages.checkout', compact('categories', 'brandss', 'wishCount'));
    }

    public function store(CheckoutRequest $request)
    {
        try{
            $order = $this->addToOrdersTables($request, null);
            Mail::send(new OrderPlaced($order));
            Cart::instance('default')->destroy();
            return redirect()->route('confirmation.index')->with('status', 'Заявка отправлено');
        } catch (CardErrorException $e){
            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Ошибка! ' . $e->getMessage());
        }
    }

    protected function addToOrdersTables($request, $error)
    {
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null ,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_adress' => $request->adress,
            'billing_city' => $request->city,
            'billing_phone' => $request->phone,
            'billing_dostavka' => $request->dostavka,
            'billing_subtotal' => $this->getNumbers()->get('subtotal'),
            'billing_total' => $this->getNumbers()->get('total'),
            'error' => $error,
        ]);

        foreach(Cart::content() as $item)
        {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }

    public function getNumbers()
    {
        $subtotal = (Cart::subtotal());
        $total = (Cart::total());

        return collect([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }
}
