<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    <h2>Новый заказ с сайта eco-life.kg</h2>

    <b>Номер заказа:</b> Заказ №{{$order->id}} <br>
    <b>E-mail заказчика:</b> {{$order->billing_email}} <br>
    <b>ФИО заказчика: </b>{{$order->billing_name}} <br>
    <b>Телефон заказчика:</b> {{$order->billing_phone}} <br>
    @if($order->billing_dostavka)
        <b>Вид доставки заказчика:</b> Самовывоз - бесплатно! <br>
    @else
        <b>Вид доставки заказчика:</b> Доставка через курьер - 200 сом! <br>
    @endif
    <b>Адрес заказчика:</b>{{$order->billing_adress}}, {{$order->billing_city}} <br>
    <b>Общая цена:</b> {{presentPrice($order->billing_total)}} сом<br>
    <br>
    @foreach($order->products as $product)
        <b>Название продукта: </b> {{$product->name}} <br>
        <b>Код продукта: </b> {{$product->kod}} <br>
        @if($product->old_price)
            <b>Цена за ед.: </b>  {{presentOldPrice($product->old_price)}} сом <br>
        @else
            <b>Цена за ед.: </b>  {{presentPrice($product->price)}} сом <br>
        @endif
        <b>Количество: </b>  {{$product->pivot-> quantity}} шт.<br>
        <hr>
    @endforeach

</body>
</html>
