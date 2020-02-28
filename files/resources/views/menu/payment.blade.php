@extends('layout')

@section('title')
    Оплата
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Оплата</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">Оплата</h5>
            </div>
        </div><br>
        <div class="row">
            <div>
                <p class="lead">
                    <b>1. Оплата наличными</b>
                </p>
                <hr>
                <p class="lead">
                    <b>2. Оплата картой</b><br>
                    В наших магазинах также принимаем безналичные расчеты через ПОС-терминал от <br><br>
                    <img src="{{asset('images/imagesdemir.png')}}" class="img-fluid" width="20%">
                    <img src="{{asset('images/12589.gif')}}" class="img-fluid" width="20%">
                </p>
                <hr>
                <p class="lead">
                    <b>3. Оплата через ЭЛСОМ</b><br><br>
                    <img src="{{asset('images/banner_00.png')}}" class="img-fluid" width="50%">
                </p>
                <hr>
                <p class="lead text-danger">
                    <b>
                    Код магазина на Московской/Исанова  - 07438 <br><br>
                    Код магазина на Мира/Айни  - 07440 <br><br>
                    ЭЛСОМ -ЭТО УДОБНЫЙ И БЕЗОПАСНЫЙ ИНСТРУМЕНТ ДЛЯ ХРАНЕНИЯ И РАСПОРЯЖЕНИЯ СВОИМИ
                    ДЕНЬГАМИ НА СЧЕТЕ ПОСРЕДСТВОМ МОБИЛЬНОГО ТЕЛЕФОНА С ДОСТУПНОСТЬЮ В РЕЖИМЕ 365/24/7 <br><br>
                    Подробнее по ссылке: https://www.elsom.kg/
                    </b>
                </p>
            </div>
        </div>
    </div>
@endsection