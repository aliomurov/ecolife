@extends('admin.layout')

@section('title')
    Отзывы
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Отзывы</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">Отзывы</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Отзывы</h6>
                    </div>
                    <div class="table-responsive">
                        @if($comments->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Товар</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                            <tr>
                                <td><a href="#">{{$comment->id}}</a></td>
                                <td>{{$comment->name}}</td>
                                <td>{{$comment->product->name}}</td>
                                @if($comment->view)
                                    <td class="text-success"><b>Опубликована</b></td>
                                @else
                                    <td class="text-danger"><b>На проверке</b></td>
                                @endif
                                <td class="edit-del">
                                    <a href="{{route('comment.edit', $comment->id)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['route' => ['comment.delete', $comment->id], 'method' => 'delete']) !!}
                                    <button class="del-bak" type="submit" href="{{route('comment.delete', $comment->id)}}">
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
                                Отзывов нет!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{$comments->links()}}
    </div>

@endsection


