@extends('admin.layout')

@section('title')
    Добавление товара
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Добавление товара</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Продукты</a></li>
                <li class="breadcrumb-item active" aria-current="page">Добавление товара</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Добавление товара</h6>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'product.store', 'method' => 'put', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Название товара') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Название товара']) !!}
                            @if($errors->has('name'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Цена') !!}
                            {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Цена товара']) !!}
                            @if($errors->has('price'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('gram', 'Вес') !!}
                            {!! Form::text('gram', null, ['class' => 'form-control', 'placeholder' => 'Вес товара']) !!}
                            @if($errors->has('gram'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('country_id', 'Страны производителя') !!}
                            {!! Form::select('country_id', $countries, null, ['class' => 'form-control', 'placeholder' => 'Выберите пункт']) !!}
                            @if($errors->has('country_id'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('brand_id', 'Бренды') !!}
                            {!! Form::select('brand_id', $brands, null, ['class' => 'form-control', 'placeholder' => 'Выберите пункт']) !!}
                            @if($errors->has('brand_id'))
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
                        <div class="form-group block-hide" style="display: none;">
                            {!! Form::label('subcategory_id', 'Подкатегории') !!}
                            {!! Form::select('subcategory_id', [''=>'Выберите категорию'], null, ['class' => 'form-control']) !!}
                            @if($errors->has('subcategory_id'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group block-cat-hide" style="display: none;">
                            {!! Form::label('categoryproduct_id', 'Категории товаров') !!}
                            {!! Form::select('categoryproduct_id', [''=>'Выберите под категорию'], null, ['class' => 'form-control']) !!}
                            @if($errors->has('categoryproduct_id'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'О товаре') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Описание товара']) !!}
                            @if($errors->has('description'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('structure', 'Состав') !!}
                            {!! Form::textarea('structure', null, ['class' => 'form-control', 'placeholder' => 'Состав']) !!}
                            @if($errors->has('structure'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('preparation', 'Способ приготовление') !!}
                            {!! Form::textarea('preparation', null, ['class' => 'form-control', 'placeholder' => 'Способ приготовление']) !!}
                            @if($errors->has('preparation'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                {!! Form::label('image', 'Выберите файл') !!}
                                {!! Form::file('image', ['class' => 'form-control']) !!}
                                @if($errors->has('image'))
                                    <span class="text-danger">Это поле обьязательно!</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('sale', 'Для распродажи') !!}
                            {!! Form::select('sale', [false => 'Выберите пункт', true => 'Да', false => 'Нет'], null, ['class' => 'form-control']) !!}
                            @if($errors->has('sale'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group block-type" id="1" style="display: none;">
                            {!! Form::label('old_price', 'Новая цена') !!}
                            {!! Form::text('old_price', null, ['class' => 'form-control', 'placeholder' => 'Новая цена']) !!}
                            @if($errors->has('old_price'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('new', 'Новинка') !!}
                            {!! Form::select('new', [false => 'Выберите пункт', true => 'Да', false => 'Нет'], null, ['class' => 'form-control']) !!}
                            @if($errors->has('new'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('available', 'В наличии') !!}
                            {!! Form::select('available', [false => 'Выберите пункт', true => 'Да', false => 'Нет'], null, ['class' => 'form-control']) !!}
                            @if($errors->has('available'))
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

@section('script')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
    <script>
        CKEDITOR.replace( 'structure' );
    </script>
    <script>
        CKEDITOR.replace( 'preparation' );
    </script>
    <script>
        $(function() {
            $('#sale').change(function(){
                $('.block-type').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>
@endsection
