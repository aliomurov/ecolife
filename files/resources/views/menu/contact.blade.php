@extends('layout')

@section('title')
    Сотрудничество
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Сотрудничество</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">Сотрудничество</h5>
            </div>
        </div>
        <br>
        <div class="row">
            <p class="lead">
                <b>Мы открыты к сотрудничеству!</b> Готовы  рассмотреть варианты с  поставщиками и  производителями
                натуральной и органической косметики,  а так же органических и экологичных  товаров для  бытового
                использования.  Дать интервью, рассказать о нашей компании.  Быть спонсором, помочь с организацией
                или провести мастер-класс.
            </p>
            <p class="lead">
                Мы заинтересованы в построении взаимовыгодного и доверительного сотрудничества и готовы предложить
                множество вариантов крепкой бизнес дружбы на любом уровне занятости!
            </p>
            <p class="lead">
                Электронный адрес для связи с нами по вопросам  сотрудничества
                <span class="text-success"><b>ecolifekg-sales@mail.ru</b></span> <br>
                или связаться по телефону :
                <span class="text-success"><b>0 772 303 303</b></span>
            </p>
        </div>
        <hr>
        <div class="row">
            <p class="lead"><b>Вакансии</b></p>
        </div>
        <div class="row">
            <img src="{{asset('images/jpg2.jpg')}}" class="img-fluid" width="50%">
            <p class="lead" style="margin-top: 10px;">
                <span class="text-success"><b>Позиция: Продавец-консультант</b></span>
                <br>
                <span class="text-success"><b>Описание вакансии:</b></span><br>
                <span class="text-danger">
                    - консультирование клиента по ассортименту;<br>
                    - продажа экотоваров (косметики, продуктов питание и бытовой химии);<br>
                    - работа с кассой;<br>
                    - мерчендайзинг;<br>
                    - поддержание чистоты рабочего места.<br>
                </span>
                <span class="text-success"><b>Требования:</b></span><br>
                <span class="text-danger">
                    - высокая работоспособность, стрессоустойчивость;<br>
                    - активная жизненная позиция;<br>
                    - умение находить контакт с любым покупателем, хорошая память;<br>
                    - приятная внешность;<br>
                    - опыт работы приветствуется<br>
                </span>
                <br>
                <span class="lead">
                    <b>Отправьте резюме на  e-mail: ecolifekg-sales@mail.ru</b>
                </span>
            </p>
        </div>
    </div>
@endsection