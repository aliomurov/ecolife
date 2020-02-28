@extends('admin.layout')

@section('title')
    Добавление новой категории товаров
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Добавление новой категории товаров</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('categoryproduct.index')}}">Категория товаров</a></li>
                <li class="breadcrumb-item active" aria-current="page">Добавление новой категории товаров</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Добавление новой категории товаров</h6>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'categoryproduct.store', 'method' => 'put', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Название категории товара') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Название категории товара']) !!}
                            @if($errors->has('name'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', 'Категории') !!}
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Выберите пункт']) !!}
                            @if($errors->has('category_id'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('subcategory_id', 'Подкатегории') !!}
                            {!! Form::select('subcategory_id', [''=>'Выберите категорию'], null, ['class' => 'form-control']) !!}
                            @if($errors->has('subcategory_id'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <br>
                        <hr>
                            {!! Form::reset('Очистить', ['class' => 'btn btn-primary']) !!}
                            {!! Form::submit('Добавить', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
