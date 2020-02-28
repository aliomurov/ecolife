@extends('admin.layout')

@section('title')
    Эко-блок
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Эко-блок</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">Эко-блок</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Эко-блок</h6>
                        <a href="{{route('blog.create')}}" class="btn btn-info mb-1">Добавить</a>
                    </div>
                    <div class="table-responsive">
                        @if($blogs->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Изображение</th>
                                <th>Текст</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td><a href="#">{{$blog->id}}</a></td>
                                <td>{{str_limit($blog->name, 20)}}</td>
                                <td>
                                    <img src='{{asset("files/storage/app/{$blog->image}")}}' class="img-thumbnail img-fluid" width="25%">
                                </td>
                                <td>{!! htmlspecialchars_decode(str_limit($blog->description, 55)) !!}</td>
                                <td class="edit-del">
                                    <a href="{{route('blog.edit', $blog->slug)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['route' => ['blog.delete', $blog->slug], 'method' => 'delete']) !!}
                                    <button class="del-bak" type="submit" href="{{route('blog.delete', $blog->slug)}}">
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
                                Эко-блок не добавлен!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{$blogs->links()}}
    </div>

@endsection


