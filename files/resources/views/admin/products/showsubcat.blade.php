@extends('admin.layout')

@section('title')
    @if(request()->categoryproduct)
        Продукты | {{$subcategory->name}} | {{$categoryProductName}}
    @else
        Продукты | {{$categoryProductName}}
    @endif
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            @if(request()->categoryproduct)
                <h1 class="h3 mb-0 text-gray-800">Продукты / {{$subcategory->name}} - {{$categoryProductName}}</h1>
            @else
                <h1 class="h3 mb-0 text-gray-800">Продукты / {{$categoryProductName}}</h1>
            @endif
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Продукты</a></li>
                @if(request()->categoryproduct)
                    <li class="breadcrumb-item">{{$subcategory->name}} - {{$categoryProductName}}</li>
                @else
                    <li class="breadcrumb-item">{{$categoryProductName}}</li>
                @endif
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        @if(request()->categoryproduct)
                            <h6 class="m-0 font-weight-bold text-primary">Продукты / {{$subcategory->name}} - {{$categoryProductName}}</h6>
                        @else
                            <h6 class="m-0 font-weight-bold text-primary">Продукты / {{$categoryProductName}}</h6>
                        @endif
                        <a href="{{route('product.create')}}" class="btn btn-info mb-1">Добавить</a>
                    </div>
                    <div class="table-responsive">
                        @if($subcatproducts->first())
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Цена</th>
                                    <th>Код товара</th>
                                    <th>Подкатегория</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subcatproducts as $product)
                                    <tr>
                                        <td><a href="#">{{$product->id}}</a></td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}} сом</td>
                                        <td>{{$product->kod}}</td>
                                        <td>{{$product->subcategory->name}}</td>
                                        <td class="edit-del">
                                            <a href="{{route('product.edit', $product->slug)}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['product.delete', $product->slug], 'method' => 'delete']) !!}
                                            <button class="del-bak" type="submit" href="{{route('product.delete', $product->slug)}}">
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
                                Продукты не добавлены!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{ $subcatproducts->appends(request()->input())->links() }}
    </div>

@endsection

@section('category')
    <div class="sidebar-heading">
        {{$subcategory->name}}
    </div>
    @foreach($categoryproducts as $catpro)
        <li class="nav-item">
            <a class="nav-link {{ request()->categoryproduct == $catpro->slug ? 'active-bg' : ''}}"
               href="{{route('product.showsubcat', [$subcategory->slug, 'categoryproduct' => $catpro->slug])}}">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>{{$catpro->name}}</span>
            </a>
        </li>
    @endforeach
@endsection


