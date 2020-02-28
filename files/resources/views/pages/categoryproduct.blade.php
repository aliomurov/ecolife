@extends('layout')

@section('title')
    @if(request()->brand)
        {{$categoryproduct->name}} | {{$productName}}
    @else
        {{$productName}}
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    @if(request()->brand)
                        <li class="breadcrumb-item" aria-current="page">{{$categoryproduct->name}}</li>
                        <li class="breadcrumb-item active" aria-current="page">Брэнд - {{$productName}}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{$productName}}</li>
                    @endif
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                @if(request()->brand)
                    <h5 class="display-4">{{$categoryproduct->name}} / Брэнд - {{$productName}}</h5>
                @else
                    <h5 class="display-4">{{$productName}}</h5>
                @endif
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-3">
                @foreach($subcategory->categoryproduct as $subcat)
                    <div class="btn-group dropright cat-menu-left">
                        <a href="{{route('pages.categoryproduct', [$category->slug, $subcat->subcategory->slug, $subcat->slug])}}"
                           class="btn btn-light text-left {{last(request()->segments()) == $subcat->slug ? 'active-category' : ''}}">
                            {{$subcat->name}} <span>({{$subcat->product->count()}})</span>
                        </a>
                    </div>
                @endforeach
                @include('include.brand-categoryproduct')
            </div>
            <div class="col-sm-9">
                <div class="product-grid-block">
                    <div>
                        <div class="shop__list nav justify-content-end" role="tablist">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
                        </div>
                    </div>
                    <div class="block-product">
                        <div class="block-product-grid">
                            @foreach($category_products as $catproduct)
                                <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a href="{{route('pages.product', [$catproduct->category->slug, $catproduct->subcategory->slug, $catproduct->categoryproduct->slug, $catproduct->slug])}}">
                                            <img class="img-fluid" src='{{asset("files/storage/app/{$catproduct->image}")}}' alt="product image">
                                        </a>
                                        @if($catproduct->new)
                                            <div class="hot__box">
                                                <span class="hot-label">NEW</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="product__content content--center">
                                        <h6>
                                            <a href="{{route('pages.product', [$catproduct->category->slug, $catproduct->subcategory->slug, $catproduct->categoryproduct->slug, $catproduct->slug])}}">
                                                {{str_limit($catproduct->name, 30)}}
                                            </a>
                                        </h6>
                                        <input data-show-caption="false" id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $catproduct->userAverageRating }}" data-size="xs" disabled="">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                @if($catproduct->old_price)
                                                    <span class="text-sm-center text-danger">
                                                    Цена: {{$catproduct->old_price}} сом
                                                </span>
                                                @else
                                                    <span class="text-sm-center">
                                                    Цена: {{$catproduct->price}} сом
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
                                                <input type="hidden" name="id" value="{{$catproduct->id}}">
                                                <input type="hidden" name="name" value="{{$catproduct->name}}">
                                                @if($catproduct->old_price)
                                                    <input type="hidden" name="old_price" value="{{$catproduct->old_price}}">
                                                @else
                                                    <input type="hidden" name="price" value="{{$catproduct->price}}">
                                                @endif
                                                <button style="background: none; border: none;">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="list-inline-item">
                                                {!! Form::open(['route' => 'wish.store', 'method' => 'post']) !!}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$catproduct->id}}">
                                                <button style="background: none; border: none;">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$catproduct->id}}">
                                                    <i class="fa fa-search-plus"></i>
                                                </a>

                                                <div class="modal fade bd-example-modal-lg-{{$catproduct->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-center" id="exampleModalLongTitle">
                                                                    <a href="{{route('pages.product', [$catproduct->category->slug, $catproduct->subcategory->slug, $catproduct->categoryproduct->slug, $catproduct->slug])}}">
                                                                        {{$catproduct->name}}
                                                                    </a>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-5">
                                                                        <img class="img-fluid img-thumbnail" src='{{asset("files/storage/app/{$catproduct->image}")}}'>
                                                                    </div>
                                                                    <div class="col-sm-7 text-left">
                                                                        <table class="table">
                                                                            <tbody>
                                                                            @if($catproduct->old_price)
                                                                                <tr>
                                                                                    <th scope="row"><s>Старая цена:</s></th>
                                                                                    <td><s>{{$catproduct->presentPrice()}} сом</s></td>
                                                                                </tr>
                                                                                <tr class="text-danger">
                                                                                    <th scope="row">Новая цена:</th>
                                                                                    <td>{{$catproduct->presentOldPrice()}} сом</td>
                                                                                </tr>
                                                                            @else
                                                                                <tr>
                                                                                    <th scope="row">Цена:</th>
                                                                                    <td>{{$catproduct->presentPrice()}} сом</td>
                                                                                </tr>
                                                                            @endif
                                                                            <tr>
                                                                                <th scope="row">Код товара:</th>
                                                                                <td>{{$catproduct->kod}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Производство</th>
                                                                                <td>{{$catproduct->country->name}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Бренд:</th>
                                                                                <td>
                                                                                    <a href="{{route('pages.brand', [$catproduct->brand->brandcategory->slug, $catproduct->brand->slug])}}">
                                                                                        {{$catproduct->brand->name}}
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="btn-modal-index">
                                                                                <th scope="row">Купить этот товар:</th>
                                                                                <td>
                                                                                    {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="id" value="{{$catproduct->id}}">
                                                                                    <input type="hidden" name="name" value="{{$catproduct->name}}">
                                                                                    @if($catproduct->old_price)
                                                                                        <input type="hidden" name="old_price" value="{{$catproduct->old_price}}">
                                                                                    @else
                                                                                        <input type="hidden" name="price" value="{{$catproduct->price}}">
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
                {{ $category_products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection
