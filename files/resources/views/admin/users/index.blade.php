@extends('admin.layout')

@section('title')
   Пользователи
@endsection

@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Пользователи
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                <li class="breadcrumb-item">
                    Пользователи
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Пользователи ({{$users->count()}})
                        </h6>
                    </div>
                    <div class="table-responsive">
                        @if($users->first())
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>ФИО</th>
                                <th>E-mail</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td><a href="#">{{$user->id}}</a></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td class="edit-del">
                                    {!! Form::open(['route' => ['user.delete', $user->id], 'method' => 'delete']) !!}
                                    <button class="del-bak" type="submit" href="{{route('user.delete', $user->id)}}">
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
                                Пользователей нет!
                            </div>
                        @endif
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        {{ $users->links() }}
    </div>

@endsection


