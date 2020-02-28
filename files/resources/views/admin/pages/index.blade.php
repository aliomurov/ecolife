@extends('admin.layout')

@section('title')
    Главная
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Главная</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Админка</li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Всего товаров</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$product_count}} ед.</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Заказы</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">+ {{$orders_count}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Пользователи</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$users_count}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Отзывы</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$comments_count}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-7 mb-4">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Новые заказы!</th>
                                <th>ФИО Заказчика</th>
                                <th>Продукт</th>
                                <th>Статус</th>
                                <th>Сумма</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><a href="{{route('order.edit', $order->id)}}">Заказ №{{$order->id}}</a></td>
                                <td>{{$order->billing_name}}</td>
                                <td>{{$order->billing_email}}</td>
                                @if($order->shipped)
                                    <td><span class="badge badge-success">Доставлено</span></td>
                                @else
                                    <td><span class="badge badge-danger">Не доставлено</span></td>
                                @endif
                                <td>{{presentPrice($order->billing_total)}} сом</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
