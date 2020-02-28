@extends('layout')

@section('title')
    Спасибо за покупку!
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                </ol>
            </nav>
        </div><br>
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="title-product">
                    <h5 class="display-4 text-center"> Спасибо за покупку!</h5>
                    <a href="{{route('pages.index')}}">Главная</a>
                </div>
            </div>
        </div>
    </div>
@endsection
