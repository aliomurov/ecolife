@extends('layout')

@section('title')
    Мои заказы
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Мои заказы</li>
                </ol>
            </nav>
        </div>
        <br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h4 class="display-4">{{auth()->user()->name}} - Мои заказы</h4>
            </div>
        </div>
        <br>
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
                    <table class="table table-bordered lead table-responsive">
                        <thead class="thead-light">
                            <tr>
                                <td class="text-center"><b><h5>Номер заказа</h5></b></td>
                                <td class="text-center"><b><h5>Сумма заказа</h5></b></td>
                                <td class="text-center"><b><h5>Дата заказа</h5></b></td>
                                <td class="text-center"><b><h5>Статус заказа</h5></b></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="text-center">
                                    <a href="{{route('pages.order.show', $order->id)}}">
                                        №{{$order->id}}
                                    </a>
                                </td>
                                <td class="text-center">{{presentPrice($order->billing_total)}} сом</td>
                                <td class="text-center">{{presentDate($order->created_at)}}</td>
                                @if($order->shipped)
                                <td class="text-center text-success"><b>Доставлено Вам</b></td>
                                @else
                                <td class="text-center text-danger"><b>В пути</b></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection
