@extends('admin.layout')

@section('title')
    {{$subcategory->name}}
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$subcategory->name}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">Под категории</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$subcategory->name}}</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$subcategory->name}}</h6>
                    </div>
                    <div class="card-body">
                        {!! Form::model($subcategory, ['route' => ['subcategory.update', $subcategory->slug], 'method' => 'post', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Название категории') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @if($errors->has('name'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', 'Категории') !!}
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                            @if($errors->has('category_id'))
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

@section('category')
    <div class="sidebar-heading">
        Категории
    </div>
    @foreach($categoriess as $category)
        <li class="nav-item">
            <a class="nav-link {{ request()->category == $category->slug ? 'active-bg' : ''}}" href="{{route('subcategory.index', ['category' => $category->slug])}}">
                <i class="fas fa-hand-point-right"></i>
                <span>{{$category->name}}</span>
            </a>
        </li>
    @endforeach
@endsection
