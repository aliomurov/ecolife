@extends('layout')

@section('title')
    Мой профиль
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Мой профиль</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">{{auth()->user()->name}}</h5>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-3">
                <div class="btn-group dropright cat-menu-left">
                    <a href="{{route('pages.users.edit')}}" class="btn btn-light text-left {{request()->route()->getName() === 'pages.users.edit' ? 'active-category' : ''}}">
                        Мои профиль
                    </a>
                </div>
                <div class="btn-group dropright cat-menu-left">
                    <a href="{{route('pages.order')}}" class="btn btn-light text-left {{request()->route()->getName() === 'pages.order' ? 'active-category' : ''}}">
                        Мои заказы
                    </a>
                </div>
            </div>
            <div class="col-sm-9">
                <form action="{{route('users.update')}}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="name"><sup class="text-danger">*</sup>ФИО</label>
                        <input type="text" class="form-control" name="name" value="{{old('name', $user->name)}}">
                    </div>
                    <div class="form-group">
                        <label for="email"><sup class="text-danger">*</sup>Email адрес</label>
                        <input type="email" class="form-control" name="email" value="{{old('email', $user->email)}}">
                    </div>
                    <div class="form-group">
                        <label for="password"><sup class="text-danger">*</sup>Пароль</label>
                        <input type="password" class="form-control" name="password" id="password">
                        @if($errors->has('password'))
                            <span class="text-danger">{{$errors->first('password')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password"><sup class="text-danger">*</sup>Повтор пароля</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password">
                        @if($errors->has('password_confirmation'))
                            <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
