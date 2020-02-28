@extends('admin.layout')

@section('title')
    Заказы
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Заказы</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">Заказы</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Заказы</h6>
                    </div>
                    <div class="table-responsive">
                        @if($orders->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Заказы</th>
                                <th>ФИО заказчика</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><a href="#">{{$order->id}}</a></td>
                                <td>Заказ №{{$order->id}}</td>
                                <td>{{$order->billing_name}}</td>
                                @if($order->shipped)
                                    <td class="text-success"><b>Доставлено</b></td>
                                @else
                                    <td class="text-danger"><b>В Пути</b></td>
                                @endif
                                <td class="edit-del">
                                    <a href="{{route('order.edit', $order->id)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['route' => ['order.delete', $order->id], 'method' => 'delete']) !!}
                                    <button class="del-bak" type="submit" href="{{route('order.delete', $order->id)}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="alert alert-light" role="alert">
                                Заказов нет!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{$orders->links()}}
    </div>

@endsection


