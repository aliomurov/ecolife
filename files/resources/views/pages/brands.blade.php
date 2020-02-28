@extends('layout')

@section('title')
    Бренды
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Бренды</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">Бренды</h5>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-3">
                @foreach($brandscategory as $brandcategory)
                    <div class="btn-group dropright cat-menu-left">
                        <a href="#"
                           class="btn btn-light text-left {{last(request()->segments()) == $brandcategory->slug ? 'active-category' : ''}}">
                            {{$brandcategory->name}}
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-9">
                <div class="product-grid-block">
                    <div class="block-product">
                        <div class="block-product-grid">
                            @foreach($brands as $product)
                                <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a href="{{route('pages.brand', $product->slug)}}">
                                            <img class="img-fluid" src='{{asset("files/storage/app/{$product->image}")}}' alt="product image">
                                        </a>
                                    </div>
                                    <div class="product__content content--center">
                                        <h6>
                                            <a href="{{route('pages.brand', $product->slug)}}">
                                                {{$product->name}}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{ $brands->links() }}
            </div>
        </div>
    </div>
@endsection
