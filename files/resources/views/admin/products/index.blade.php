@extends('admin.layout')

@section('title')
   Продукты
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Продукты</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">Продукты</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Продукты</h6>
                        <a href="{{route('product.create')}}" class="btn btn-info mb-1">Добавить</a>
                        <a href="{{route('product.export')}}" class="btn btn-info mb-1">Скачать exel файл</a>
                    </div>
                    <div class="table-responsive">
                        @if($products->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Цена</th>
                                <th>Код товара</th>
                                <th>Категория</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td><a href="#">{{$product->id}}</a></td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}} сом</td>
                                <td>{{$product->kod}}</td>
                                <td>{{$product->subcategory->category->name}}</td>
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
                <br>
                <div class="import">
                    <form action="{{route('product.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-control">
                            <input type="file" name="import_file">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fa fa-file-import"></i> Импортировать
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{$products->links()}}
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
                        <a class="collapse-item
                    {{ request()->subcategory == $subcategory->slug ? 'active-bg' : ''}}"
                           href="{{route('product.showsubcat', $subcategory->slug)}}">
                            {{$subcategory->name}}
                        </a>
                    @endforeach
                </div>
            </div>
        </li>
    @endforeach
@endsection


