@extends('layout')

@section('title')
    Доставка
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Доставка</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">Доставка</h5>
            </div>
        </div><br>
        <div class="row">
            <p class="lead">Стоимость доставки</p>
        </div>
        <div class="row">
            <div>
                <ul class="list-group list-group-flush text-danger lead">
                    <li class="list-group-item">- При покупке товаров на сумму свыше 2000 сом доставка по городу <b>*БЕСПЛАТНО</b></li>
                    <li class="list-group-item">- При покупке товаров на сумму менее 2000 сом доставка по городу 100 сом.</li>
                    <li class="list-group-item">- В отдалённые районы города- цена договорная</li>
                </ul>
            </div>
            <div>
                <hr>
                <p class="lead">
                    Если Вы по каким-то личным причинам решили отказаться от заказа, сообщите нам
                    об этом по телефону (0770) 800-688 (0777) 950 099 не позднее, чем за 3 часа до согласованного времени доставки.
                    Иначе, в случае Вашего отказа от доставленного заказа, стоимость курьерской доставки должна быть оплачена.
                </p>
                <hr>
                <p class="lead">
                    После оформления Вашего заказа наш менеджер обязательно свяжется с Вами, чтобы уточнить точный адрес и время доставки.
                    <br>
                    ЕСЛИ В ТЕЧЕНИИ 12 часов мы не позвонили Вам, значит Ваш заказ не дошёл к нам.
                    В таком случае повторите заказ, ПОДТВЕРДИВ ЕГО, или позвоните по телефону
                    <br>
                    +996 770 800 688 <br>
                    +996 777 950 099
                    <br>
                    При совершении заказа до 12 часов доставка осуществляется в этот же рабочий день.
                    При совершении заказа после 12 часов доставка - на следующий рабочий день.
                </p>
                <hr>
                <p class="lead text-success"><b>По субботам и воскресеньям доставка не осуществляется!</b></p>
                <hr>
                <p class="lead text-danger">
                    <b>
                        Внимание! Неправильно указанный номер телефона, неточный или неполный адрес могут
                        привести к проблемам при доставке заказа!
                        Пожалуйста, внимательно проверяйте Ваши персональные данные при оформлении заказа.
                    </b>
                </p>
                <hr>
                <div>
                    <p class="lead">Карта стоимости доставки по городу</p>
                    <button data-toggle="modal" data-target=".bd-example-modal-lg">
                        <img src="{{asset('images/karta.jpg')}}" class="img-fluid img-thumbnail">
                    </button>

                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Карта стоимости доставки по городу</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{asset('images/karta.jpg')}}" class="img-thumbnail" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection