@extends('layout')

@section('title')
    Оформление
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Оформление</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">Оформление заказа</h5>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-12">
                {!! Form::open(['route' => 'checkout.store', 'method' => 'post', 'id' => 'payment-form' ]) !!}
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <fieldset id="account">
                            <legend>Ваши персональные данные</legend>
                            <div class="form-group">
                                {!! Form::label('name', 'Ведите имя') !!}
                                @if(auth()->user())
                                    {!! Form::text('name', auth()->user()->name, ['class'=>'form-control', 'placeholder'=>'Ведите имя', 'readonly']) !!}
                                @else
                                    {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Ведите имя', 'required']) !!}
                                @endif                                    
                                @if($errors->has('name'))
                                    <small class="form-text text-danger">Это поле обьязательно</small>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'E-mail адрес') !!}
                                @if(auth()->user())
                                    {!! Form::email('email', auth()->user()->email, ['class'=>'form-control', 'placeholder'=>'Ведите email', 'readonly']) !!}
                                @else
                                    {!! Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Ведите email', 'required']) !!}
                                @endif
                                @if($errors->has('email'))
                                    <small class="form-text text-danger">{!! $errors->first('email') !!} </small>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('phone', 'Телефон') !!}
                                {!! Form::text('phone', old('phone'), ['class'=>'form-control', 'placeholder'=>'Ведите номер телефона для связи', 'required']) !!}
                                @if($errors->has('phone'))
                                    <small class="form-text text-danger">Это поле обьязательно</small>
                                @endif
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <fieldset id="address">
                            <legend>Ваш адрес</legend>
                            <div class="form-group">
                                {!! Form::label('adress', 'Адрес доставки') !!}
                                {!! Form::text('adress', old('adress'), ['class'=>'form-control', 'placeholder'=>'Ведите адрес доставки', 'required']) !!}
                                @if($errors->has('adress'))
                                    <small class="form-text text-danger">Это поле обьязательно</small>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('city', 'Город') !!}
                                {!! Form::text('city', old('city'), ['class'=>'form-control', 'placeholder'=>'Ведите город доставки', 'required']) !!}
                                @if($errors->has('city'))
                                    <small class="form-text text-danger">Это поле обьязательно</small>
                                @endif
                            </div>
                            @if(Cart::total() >= 5000)
                                <div class="form-group">
                                    {!! Form::label('dostavka', 'Метод доставки') !!}
                                    <select name="dostavka" class="form-control">
                                        <option value="1">Бесплатная доставка</option>
                                    </select>
                                </div>
                            @else
                                <div class="form-group">
                                    {!! Form::label('dostavka', 'Метод доставки') !!}
                                    <select name="dostavka" class="form-control">
                                        <option value="">Выберите пункт</option>
                                        <option value="1">Самовывоз</option>
                                        <option value="0">Доставка через курьер - 200 сом</option>
                                    </select>
                                    @if($errors->has('dostavka'))
                                        <small class="form-text text-danger">Это поле обьязательно</small>
                                    @endif
                                </div>
                            @endif
                        </fieldset>
                    </div>
                </div>
                <hr>
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    <div class="table-content wnro__table table-responsive">
                        <fieldset id="address">
                            <legend>Ваши заказы!</legend>
                        </fieldset>
                        <table>
                            <thead class="lead">
                            <tr>
                                <th>Картинка</th>
                                <th>Наименование товара</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                                <th>Всего к оплате</th>
                                <th>Бренд</th>
                            </tr>
                            </thead>
                            <tbody class="lead">
                            @foreach(Cart::content() as $item)
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src='{{asset("files/storage/app/{$item->model->image}")}}' alt="product img" class="img-fluid img-thumbnail">
                                    </td>
                                    <td class="product-name">
                                        <a class="lead" href="{{route('pages.product', [$item->model->category->slug, $item->model->subcategory->slug, $item->model->categoryproduct->slug, $item->model->slug])}}">{{$item->model->name}}</a>
                                    </td>
                                    @if($item->model->presentOldPrice())
                                        <td class="product-price">
                                            {{$item->model->presentOldPrice()}} сом
                                        </td>
                                    @else
                                        <td class="product-price">
                                            <span class="amount">{{$item->model->presentPrice()}} сом</span>
                                        </td>
                                    @endif
                                    <td class="product-quantity">
                                        <span class="amount">{{$item->qty}} шт.</span>
                                    </td>
                                    @if($item->model->presentOldPrice())
                                        <td class="product-subtotal">{{presentOldPrice($item->subtotal)}} сом</td>
                                    @else
                                        <td class="product-subtotal">{{presentPrice($item->subtotal)}} сом</td>
                                    @endif
                                    <td class="product-remove">
                                        {{$item->model->brand->name}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="col-md-12 col-xs-12">
                    <div class="table-content wnro__table table-responsive">
                        <table>
                            <thead class="lead">
                            <tr>
                                <th>Ваш подарок</th>
                                <th><img src="{{asset('images/9d575282b7d14d9fda5d651012abe46f.png')}}" width="30%"></th>
                                <th>Подарок-сюрприз</th>
                                <th>Кол-во: 1шт</th>
                                <th>Бесплатно</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Оформить</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
