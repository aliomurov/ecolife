@extends('admin.layout')

@section('title')
    Слайдер
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Слайдер</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">Слайдер</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Слайдер</h6>
                        <a href="{{route('slider.create')}}" class="btn btn-info mb-1">Добавить</a>
                    </div>
                    <div class="table-responsive">
                        @if($sliders->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Изображение</th>
                                <th>Описание</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <td><a href="#">{{$slider->id}}</a></td>
                                <td>{{str_limit($slider->name, 20)}}</td>
                                <td>
                                    <img src='{{asset("files/storage/app/{$slider->image}")}}' class="img-thumbnail img-fluid" width="25%">
                                </td>
                                <td>{!! htmlspecialchars_decode(str_limit($slider->description, 55)) !!}</td>
                                <td class="edit-del">
                                    <a href="{{route('slider.edit', $slider->slug)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['route' => ['slider.delete', $slider->slug], 'method' => 'delete']) !!}
                                    <button class="del-bak" type="submit" href="{{route('slider.delete', $slider->slug)}}">
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
                                Слайдер не добавлен!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{$sliders->links()}}
    </div>

@endsection


