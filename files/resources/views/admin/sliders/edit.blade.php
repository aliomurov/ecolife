@extends('admin.layout')

@section('title')
    {{$slider->name}}
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$slider->name}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('slider.index')}}">Слайдеры</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$slider->name}}</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$slider->name}}</h6>
                    </div>
                    <div class="card-body">
                        {!! Form::model($slider, ['route' => ['slider.update', $slider->slug], 'method' => 'post', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Название слайдера') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @if($errors->has('name'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Описание') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                            @if($errors->has('description'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', 'Изображение') !!}
                            <div>
                                <img src='{{asset("files/storage/app/{$slider->image}")}}' class="img-thumbnail img-fluid" alt="Responsive image" width="20%">
                            </div>
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
                        {!! Form::submit('Сохранить', ['class' => 'btn btn-success']) !!}
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
@endsection
