@extends('admin.layout')

@section('title')
    {{$category->name}}
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$category->name}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('category.index')}}">Категории</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$category->name}}</h6>
                    </div>
                    <div class="card-body">
                        {!! Form::model($category, ['route' => ['category.update', $category->slug], 'method' => 'post', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Название категории') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @if($errors->has('name'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        {!! Form::submit('Сохранить', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
