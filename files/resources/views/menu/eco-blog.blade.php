@extends('layout')

@section('title')
    Эко-блок
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Эко-блок</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">Эко-блок</h5>
            </div>
        </div>
        <div class="row">
            <p class="lead">
                Все записи эко блока
            </p>
        </div>
        <div class="row">
            <div class="new-block">
                @foreach($blogs as $blog)
                    <div class="card card-block-block">
                        <img class="card-img-top img-fluid img-thumbnail" src='{{asset("files/storage/app/{$blog->image}")}}' alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{route('pages.blog', $blog->slug)}}">{{str_limit($blog->name, 35)}}</a>
                            </h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="lead">
                {{$blogs->links()}}
            </div>
        </div>
    </div>
@endsection