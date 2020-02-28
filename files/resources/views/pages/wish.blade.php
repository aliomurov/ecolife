@extends('layout')

@section('title')
    Избранные товары
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Избранные товары</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">Избранные товары</h5>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-12">
                <div class="product-grid-block">
                    <div class="block-product">
                        <div class="block-product-grid">
                            @foreach($wishProducts as $p)
                                <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a href="{{route('pages.product', [$p->product->category->slug, $p->product->subcategory->slug, $p->product->categoryproduct->slug, $p->product->slug])}}">
                                            <img class="img-fluid" src='{{asset("files/storage/app/{$p->product->image}")}}' alt="product image">
                                        </a>
                                        @if($p->product->new)
                                            <div class="hot__box">
                                                <span class="hot-label">NEW</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="product__content content--center">
                                        <h6>
                                            <a href="{{route('pages.product', [$p->product->category->slug, $p->product->subcategory->slug, $p->product->categoryproduct->slug, $p->product->slug])}}">
                                                {{str_limit($p->product->name, 45)}}
                                            </a>
                                        </h6>
                                        <input data-show-caption="false" id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $p->product->userAverageRating }}" data-size="xs" disabled="">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                @if($p->product->old_price)
                                                    <span class="text-sm-center text-danger">
                                                    Цена: {{$p->product->old_price}} сом
                                                </span>
                                                @else
                                                    <span class="text-sm-center">
                                                    Цена: {{$p->product->price}} сом
                                                </span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-footer">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$p->product->id}}">
                                                <input type="hidden" name="name" value="{{$p->product->name}}">
                                                @if($p->product->old_price)
                                                    <input type="hidden" name="old_price" value="{{$p->product->old_price}}">
                                                @else
                                                    <input type="hidden" name="price" value="{{$p->product->price}}">
                                                @endif
                                                <button style="background: none; border: none;">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="list-inline-item">
                                                {!! Form::open(['route' => ['wish.delete', $p->id], 'method' => 'delete']) !!}
                                                <button style="background: none; border: none;">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$p->product->id}}">
                                                    <i class="fa fa-search-plus"></i>
                                                </a>

                                                <div class="modal fade bd-example-modal-lg-{{$p->product->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-center" id="exampleModalLongTitle">
                                                                    <a href="{{route('pages.product', [$p->product->category->slug, $p->product->subcategory->slug, $p->product->categoryproduct->slug, $p->product->slug])}}">
                                                                        {{$p->product->name}}
                                                                    </a>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-5">
                                                                        <img class="img-fluid img-thumbnail" src='{{asset("files/storage/app/{$p->product->image}")}}'>
                                                                    </div>
                                                                    <div class="col-sm-7 text-left">
                                                                        <table class="table">
                                                                            <tbody>
                                                                            @if($p->product->old_price)
                                                                                <tr>
                                                                                    <th scope="row"><s>Старая цена:</s></th>
                                                                                    <td><s>{{$p->product->presentPrice()}} сом</s></td>
                                                                                </tr>
                                                                                <tr class="text-danger">
                                                                                    <th scope="row">Новая цена:</th>
                                                                                    <td>{{$p->product->presentOldPrice()}} сом</td>
                                                                                </tr>
                                                                            @else
                                                                                <tr>
                                                                                    <th scope="row">Цена:</th>
                                                                                    <td>{{$p->product->presentPrice()}} сом</td>
                                                                                </tr>
                                                                            @endif
                                                                            <tr>
                                                                                <th scope="row">Код товара:</th>
                                                                                <td>{{$p->product->kod}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Производство</th>
                                                                                <td>{{$p->product->country->name}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Бренд:</th>
                                                                                <td>
                                                                                    <a href="{{route('pages.brand', [$p->product->brand->brandcategory->slug, $p->product->brand->slug])}}">
                                                                                        {{$p->product->brand->name}}
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Купить этот товар:</th>
                                                                                <td class="btn-modal-index">
                                                                                    {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="id" value="{{$p->product->id}}">
                                                                                    <input type="hidden" name="name" value="{{$p->product->name}}">
                                                                                    @if($p->product->old_price)
                                                                                        <input type="hidden" name="old_price" value="{{$p->product->old_price}}">
                                                                                    @else
                                                                                        <input type="hidden" name="price" value="{{$p->product->price}}">
                                                                                    @endif
                                                                                    <button type="submit" class="btn btn-success btn-lg">
                                                                                        <i class="fas fa-cart-arrow-down"></i> В корзину
                                                                                    </button>
                                                                                    {!! Form::close() !!}
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{ $wishProducts->links() }}
            </div>
        </div>
    </div>
@endsection
