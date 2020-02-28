@extends('admin.layout')

@section('title')
    Заказ №{{$id->id}}
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Заказ №{{$id->id}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('order.index')}}">Заказы</a></li>
                <li class="breadcrumb-item active" aria-current="page">Заказ №{{$id->id}}</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    {!! Form::model($id, ['route' => ['order.update', $id->id], 'method' => 'post', 'files' => true]) !!}
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Заказ №{{$id->id}} - ФИО заказчика: {{$id->billing_name}}</h6>
                        <div class="form-group">
                            {!! Form::label('shipped', 'Изменить стату доставки') !!}
                            {!! Form::select('shipped', [true => 'Доставлено', false => 'В пути'], null, ['class' => 'form-control']) !!}
                            @if($errors->has('shipped'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="col-sm-12">
                                <div>
                                    <div>
                                        <table class="table table-bordered lead">
                                            <thead class="thead-light">
                                            <tr>
                                                <td class="text-left"><b><h5>Заказ №{{ $id->id }}</h5></b></td>
                                                <td class="text-left"><b><h5>Дата заказа - {{ presentDate($id->created_at) }}</h5></b></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-left">ФИО заказчика:</td>
                                                <td class="text-left">{{ $id->billing_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Email адрес:</td>
                                                <td class="text-left">{{ $id->billing_email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Адрес доставки:</td>
                                                <td class="text-left">{{ $id->billing_adress }}, {{ $id->billing_city }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Телефон:</td>
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
                                                <td class="text-left">Статус:</td>
                                                @if($id->shipped)
                                                    <td class="text-left" style="color: green; font-weight: bold;">Доставлено</td>
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
                                        <h5>Товары</h5>
                                    </div>
                                    <div class="table-content">
                                        <table class="table table-bordered lead">
                                            <thead class="thead-light lead">
                                            <tr>
                                                <th>Товар</th>
                                                <th>Цена товара</th>
                                                <th>Кол-во</th>
                                                <th>Бренд</th>
                                                <th>Артикул</th>
                                            </tr>
                                            </thead>
                                            <tbody class="lead">
                                            @foreach($products as $product)
                                                <tr>
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
                        <br>
                        {!! Form::submit('Изменить статус', ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
