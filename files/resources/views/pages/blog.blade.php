@extends('layout')

@section('title')
    {{$blog->name}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Эко-блок</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$blog->name}}</li>
                </ol>
            </nav>
        </div><br>
        <div class="row justify-content-between">
            <div class="col-sm-8">
                <blockquote class="blockquote text-left blog-single-title">
                    <h1 class="mb-0">{{$blog->name}}</h1>
                </blockquote>
                <blockquote class="blockquote text-right blog-single-title">
                    <footer class="blockquote-footer"><cite title="Source Title">{{$blog->created_at}}</cite></footer>
                </blockquote>
                <img src='{{asset("files/storage/app/{$blog->image}")}}' class="img-fluid img-thumbnail"><br>
                {!! htmlspecialchars_decode($blog->description) !!}
            </div>
            <div class="col-sm-4"><br>
                <div class="text-center">
                    <h5>Эко блок</h5>
                </div>
                <br>
                <ul class="list-unstyled">
                    @foreach($blogs as $blog)
                        <li class="media eco-block-a">
                            <img src='{{asset("files/storage/app/{$blog->image}")}}' class="mr-3" width="20%">
                            <div class="media-body">
                                <h6 class="mt-0 mb-1"><a href="{{route('pages.blog', $blog->slug)}}">{{str_limit($blog->name, 20)}}</a></h6>
                                {!! htmlspecialchars_decode(str_limit($blog->description, 55)) !!}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection