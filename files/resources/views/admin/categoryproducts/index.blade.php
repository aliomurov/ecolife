@extends('admin.layout')

@section('title')
   Категория товаров
   @if($subcategoryName)
       / {{$subcategoryName}}
   @endif
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Категория товаров
                @if($subcategoryName)
                    / {{$subcategoryName}}
                @endif
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">
                    Категория товаров
                    @if($subcategoryName)
                        / {{$subcategoryName}}
                    @endif
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Категория товаров
                            @if($subcategoryName)
                                / {{$subcategoryName}}
                            @endif
                        </h6>
                        <a href="{{route('categoryproduct.create')}}" class="btn btn-info mb-1">Добавить</a>
                    </div>
                    <div class="table-responsive">
                        @if($categoryproducts->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Под категория</th>
                                <th>Категория</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categoryproducts as $catpro)
                            <tr>
                                <td><a href="#">{{$catpro->id}}</a></td>
                                <td>{{$catpro->name}}</td>
                                <td>{{$catpro->subcategory->name}}</td>
                                <td>{{$catpro->subcategory->category->name}}</td>
                                <td class="edit-del">
                                    <a href="{{route('categoryproduct.edit', $catpro->slug)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {!! Form::open(['route' => ['categoryproduct.delete', $catpro->slug], 'method' => 'delete']) !!}
                                    <button class="del-bak" type="submit" href="{{route('categoryproduct.delete', $catpro->slug)}}">
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
                                Категория товаров не добавлены!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{ $categoryproducts->appends(request()->input())->links() }}
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
        <div id='collapseBootstrap-{{$category->id}}' class="collapse
        {{last(request()->segments()) == $subcategory->firstOr()->slug ? 'show' : ''}}"

             aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{$category->name}}</h6>
                @foreach($category->subcategory as $subcategory)
                <a class="collapse-item
                    {{ request()->subcategory == $subcategory->slug ? 'active-bg' : ''}}"
                    href="{{route('categoryproduct.index', ['subcategory' => $subcategory->slug])}}">
                    {{$subcategory->name}}
                </a>
                @endforeach
            </div>
        </div>
    </li>
    @endforeach
@endsection


