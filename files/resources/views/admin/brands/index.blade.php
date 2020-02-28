@extends('admin.layout')

@section('title')
    Бренды
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Бренды</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">Бренды</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Бренды</h6>
                        <a href="{{route('brand.create')}}" class="btn btn-info mb-1">Добавить</a>
                    </div>
                    <div class="table-responsive">
                        @if($brands->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Категория</th>
                                <th>Изображение</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                            <tr>
                                <td><a href="#">{{$brand->id}}</a></td>
                                <td>{{$brand->name}}</td>
                                <td>{{$brand->brandcategory->name}}</td>
                                <td>
                                    <img src='{{asset("files/storage/app/{$brand->image}")}}' class="img-thumbnail img-fluid" width="25%">
                                </td>
                                <td class="edit-del">
                                    <a href="{{route('brand.edit', $brand->slug)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['route' => ['brand.delete', $brand->slug], 'method' => 'delete']) !!}
                                    <button class="del-bak" type="submit" href="{{route('brand.delete', $brand->slug)}}">
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
                                Бренды не добавлены!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{$brands->links()}}
    </div>

@endsection


