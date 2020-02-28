@extends('admin.layout')

@section('title')
    {{$id->name}}
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$id->name}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('comment.index')}}">Отзывы</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$id->name}}</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    {!! Form::model($id, ['route' => ['comment.update', $id->id], 'method' => 'post', 'files' => true]) !!}
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$id->name}}</h6>
                        <div class="form-group">
                            {!! Form::label('view', 'Опубликовать отзыв или нет') !!}
                            {!! Form::select('view', [true => 'Да', false => 'Нет'], null, ['class' => 'form-control']) !!}
                            @if($errors->has('view'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <img src="{{asset('images/1.jpg')}}" class="mr-3" width="8%">
                            <div class="media-body">
                                <blockquote class="blockquote">
                                    <p class="mb-0">Имя: {{$id->name}}</p>
                                    <p class="mb-0">Email: {{$id->email}}</p><br>
                                    <p class="mb-0">Отзыв:</p>
                                    <footer class="blockquote-footer">
                                        <cite title="Source Title">{{$id->subject}}</cite>
                                    </footer>
                                </blockquote>
                                <blockquote class="blockquote text-right">
                                    <footer class="blockquote-footer">{{$id->created_at}}</footer>
                                </blockquote>
                            </div>
                        </div>
                        {!! Form::submit('Опубликовать', ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
