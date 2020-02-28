@extends('layout')

@section('title')
    Оптовая торговля
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Оптовая торговля</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">Оптовая торговля</h5>
            </div>
        </div><br>
        <div class="row">
            <p class="lead">
                <b>Мультибрендовый дистрибьютор экотоваров</b>
            </p>
            <p class="lead">
                Наша компания имеет более 3 лет успешного опыта продаж экотоваров оптом.
                Наши партнеры знают нас как, надежного поставщика, сочетающий низкие цены с высоким качеством продукции.
            </p>
            <p class="lead">
                Мы открыты для различных вариантов сотрудничества и всегда готовы обсудить возможные варианты.
                Опираясь на собственный опыт, мы поможем найти правильное решение и подобрать наиболее выгодные
                условия, которые идеально подойдут вашему бизнесу. Вместе мы придем к успеху.
            </p>
        </div>
        <div class="row">
            <p class="lead">
                <b>Почему сотрудничество с нами выгодно:</b>
            </p>
        </div>
        <div class="row">
            <div class="lead">
                <ul class="list-group list-group-flush text-danger lead">
                    <li class="list-group-item">- Большой ассортимент товара</li>
                    <li class="list-group-item">- Низкие цены</li>
                    <li class="list-group-item">- Минимальный объем закупки 5000сом</li>
                    <li class="list-group-item">- Индивидуальный подход к каждому клиенту</li>
                </ul>
            </div>
        </div>
        <br>
        <div class="row">
            <p class="lead">
                <b class="text-success">Для получения оптового прайса пишите нам на эл.почту ecolifekg-sales@mail.ru</b>
            </p>
        </div>
    </div>
@endsection