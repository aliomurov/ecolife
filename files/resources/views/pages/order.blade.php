@extends('layout')

@section('title')
    Заказ №-{{$id->id}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item" aria-current="page">Мои заказы</li>
                    <li class="breadcrumb-item active" aria-current="page">Заказ №-{{$id->id}}</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">{{auth()->user()->name}} - Мои заказы - Заказ №-{{$id->id}}</h5>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-3">
                <div class="btn-group dropright cat-menu-left">
                    <a href="{{route('pages.users.edit')}}" class="btn btn-light text-left {{request()->route()->getName() === 'pages.users.edit' ? 'active-category' : ''}}">
                        Мои профиль
                    </a>
                </div>
                <div class="btn-group dropright cat-menu-left">
                    <a href="{{route('pages.order')}}" class="btn btn-light text-left {{request()->route()->getName() === 'pages.order' ? 'active-category' : ''}}">
                        Мои заказы
                    </a>
                </div>
            </div>
            <div class="col-sm-9">
                <div>
                    <div>
                        <table class="table table-bordered lead table-responsive">
                            <thead class="thead-light">
                            <tr>
                                <td class="text-left"><b><h5>Заказ №{{ $id->id }}</h5></b></td>
                                <td class="text-left"><b><h5>Дата заказа - {{ presentDate($id->created_at) }}</h5></b></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-left">Ваше ФИО:</td>
                                <td class="text-left">{{ $id->billing_name }}</td>
                            </tr>
                            <tr>
                                <td class="text-left">Ваш email адрес:</td>
                                <td class="text-left">{{ $id->billing_email }}</td>
                            </tr>
                            <tr>
                                <td class="text-left">Ваш адрес доставки:</td>
                                <td class="text-left">{{ $id->billing_adress }}, {{ $id->billing_city }}</td>
                            </tr>
                            <tr>
                                <td class="text-left">Ваш телефон:</td>
                                <td class="text-left">{{ $id->billing_phone }}</td>
                            </tr>
                            <tr>
                                <td class="text-left">Вид доставки:</td>
                                @if($id->billing_dostavka)
                                    <td class="text-left">Самовывоз</td>
                                @else
                                    <td class="text-left">Доставка через курьер - 200 сом</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-left">Отслеживание:</td>
                                @if($id->shipped)
                                    <td class="text-left" style="color: green; font-weight: bold;">Доставлено к Вам</td>
                                @else
                                    <td class="text-left" style="color: red; font-weight: bold;">В пути</td>
                                @endif
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="text-left"><b><h5>Всего к оплате:</h5></b></td>
                                <td class="text-left"><b><h5>{{presentPrice($id->billing_total)}} сом</h5></b></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <hr>
                    <div class="lead">
                        <h5>Ваши товары</h5>
                    </div>
                    <div class="table-content">
                        <table class="table-responsive">
                            <thead class="lead">
                            <tr>
                                <th>Картинка</th>
                                <th>Наименование товара</th>
                                <th>Цена товара</th>
                                <th>Кол-во</th>
                                <th>Бренд</th>
                                <th>Артикул</th>
                            </tr>
                            </thead>
                            <tbody class="lead">
                            @foreach($products as $product)
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src='{{asset("files/storage/app/{$product->image}")}}' alt="product img" class="img-fluid img-thumbnail">
                                    </td>
                                    <td class="product-name">
                                        <a class="lead" href="{{route('pages.product', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug])}}">
                                            {{str_limit($product->name, 45)}}
                                        </a>
                                    </td>
                                    @if($product->presentOldPrice())
                                        <td class="product-price">
                                            <span class="lead">{{$product->presentOldPrice()}} сом</span>
                                        </td>
                                    @else
                                        <td class="product-price">
                                            <span class="lead">{{$product->presentPrice()}} сом</span>
                                        </td>
                                    @endif
                                    <td class="product-price">
                                        <span class="lead">{{$product->pivot->quantity}} ед.</span>
                                    </td>
                                    <td class="product-price">
                                        <span class="lead">{{$product->brand->name}}</span>
                                    </td>
                                    <td class="product-price">
                                        <span class="lead">{{$product->kod}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
