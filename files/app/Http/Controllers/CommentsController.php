<?php

namespace App\Http\Controllers;

use App\Category;
use App\Categoryproduct;
use App\Comment;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CommentsController extends Controller
{
    public function store(Category $category, Subcategory $subcategory, Categoryproduct $categoryproduct, Product $product, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required'
        ]);

        if(Comment::where('email', Input::get('email'))->where('product_id', $product->id)->exists())
        {
            return back()->with('message', 'Ваш уже оставляли отзыв на данный товар!');
        }

        Comment::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'subject' => $request['subject'],
            'product_id' => $product->id
        ]);

        return redirect()->back()->with('message', 'Успешно отправлен!');
    }
}
