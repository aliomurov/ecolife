@extends('admin.layout')

@section('title')
    {{$categoryName}}
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$categoryName}}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">{{$categoryName}}</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$categoryName}}</h6>
                        <a href="{{route('subcategory.create')}}" class="btn btn-info mb-1">Добавить</a>
                    </div>
                    <div class="table-responsive">
                        @if($subcategories->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Категория</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subcategories as $subcategory)
                            <tr>
                                <td><a href="#">{{$subcategory->id}}</a></td>
                                <td>{{$subcategory->name}}</td>
                                <td>{{$subcategory->category->name}}</td>
                                <td class="edit-del">
                                    <a href="{{route('subcategory.edit', $subcategory->slug)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['route' => ['subcategory.delete', $subcategory->slug], 'method' => 'delete']) !!}
                                    <button class="del-bak" type="submit" href="{{route('subcategory.delete', $subcategory->slug)}}">
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
                                {{$categoryName}} не добавлены!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{ $subcategories->appends(request()->input())->links() }}
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


