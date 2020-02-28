@extends('admin.layout')

@section('title')
    Страны производства
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Страны производства</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">Страны производства</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Страны производства</h6>
                        <a href="{{route('country.create')}}" class="btn btn-info mb-1">Добавить</a>
                    </div>
                    <div class="table-responsive">
                        @if($countries->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($countries as $country)
                            <tr>
                                <td><a href="#">{{$country->id}}</a></td>
                                <td>{{$country->name}}</td>
                                <td class="edit-del">
                                    <a href="{{route('country.edit', $country->slug)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['route' => ['country.delete', $country->slug], 'method' => 'delete']) !!}
                                    <button class="del-bak" type="submit" href="{{route('country.delete', $country->slug)}}">
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
                                Страны производства не добавлены!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{$countries->links()}}
    </div>

@endsection


