@extends('admin.layout')

@section('title')
    {{$categoryproduct->name}}
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$categoryproduct->name}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('categoryproduct.index')}}">Категория товаров</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$categoryproduct->name}}</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$categoryproduct->name}}</h6>
                    </div>
                    <div class="card-body">
                        {!! Form::model($categoryproduct, ['route' => ['categoryproduct.update', $categoryproduct->slug], 'method' => 'post', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Название категории товара') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @if($errors->has('name'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', 'Категория') !!}
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                            @if($errors->has('category_id'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('subcategory_id', 'Под категория') !!}
                            {!! Form::select('subcategory_id', $subcategories, null, ['class' => 'form-control']) !!}
                            @if($errors->has('subcategory_id'))
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap-{{$category->id}}"
               aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>{{$category->name}}</span>
            </a>
            <div id='collapseBootstrap-{{$category->id}}' class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">{{$category->name}}</h6>
                    @foreach($category->subcategory as $subcategory)
                        <a class="collapse-item {{ request()->subcategory == $subcategory->slug ? 'active-bg' : ''}}" href="{{route('categoryproduct.index', ['subcategory' => $subcategory->slug])}}">
                            {{$subcategory->name}}
                        </a>
                    @endforeach
                </div>
            </div>
        </li>
    @endforeach
@endsection
