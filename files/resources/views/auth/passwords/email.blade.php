@extends('layout')

@section('title')
    Сброс пароля
@endsection

@section('content')
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Сброс пароля</li>
            </ol>
        </nav>
    </div><br>
    <div class="row">
        <div class="title-product">
            <h5 class="display-4">Сброс пароля</h5>
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {!! Form::open(['route' => 'password.email', 'method' => 'post', 'files'=> true]) !!}
                @csrf
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-mail адрес</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Отправить ссылку сброса пароля
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
