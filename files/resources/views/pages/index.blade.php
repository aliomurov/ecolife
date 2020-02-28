@extends('layout')

@section('title')
    Главная
@endsection

@section('content')
    <div class="container">
        <div class="slider">
            <div class="slider-index">
                @foreach($sliders as $slider)
                    <div class="slider-img-eco">
                        <img src='{{asset("files/storage/app/{$slider->image}")}}' class="img-fluid">
                        <div class="body-slider">
                            <h2 class="h2">{{$slider->name}}</h2>
                            <p class="lead">
                                {!! htmlspecialchars_decode($slider->description) !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container">
        <div class="new">
            <div class="title-new">
                <h2>НОВИНКИ</h2>
                <a class="lead" href="{{route('pages.news')}}">Все новинки</a>
            </div>
            <br>
            <div class="row justify-content-center tab-panel-eco">
                <ul class="nav nav-pills mb-3 lead" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Рекомендации</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Бестселлеры</a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="new-block">
                            @foreach($products_new as $product)
                                <div class="card">
                                    <div class="product-image product__thumb">
                                        <a class="index-new">
                                            <img class="card-img-top" src='{{asset("files/storage/app/{$product->image}")}}' alt="Card image cap">
                                            @if($product->new)
                                                <span>новинка</span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <input data-show-caption="false" id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $product->userAverageRating }}" data-size="xs" disabled="">
                                            <a href="{{route('pages.product', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug])}}">
                                                {{str_limit($product->name, 25)}}
                                            </a>
                                        </h5>
                                        <p class="card-text card-text-eco">
                                            @if($product->old_price)
                                                <span class="text-danger lead">{{$product->presentOldPrice()}} сом </span>
                                            @else
                                                <span class="lead">{{$product->presentPrice()}} сом</span>
                                            @endif
                                        </p>
                                        <ul class="list-inline hover-eco">
                                            <li class="list-inline-item">
                                                {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$product->id}}">
                                                <input type="hidden" name="name" value="{{$product->name}}">
                                                @if($product->old_price)
                                                    <input type="hidden" name="old_price" value="{{$product->old_price}}">
                                                @else
                                                    <input type="hidden" name="price" value="{{$product->price}}">
                                                @endif
                                                <button style="background: none; border: none;">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="list-inline-item">
                                                {!! Form::open(['route' => 'wish.store', 'method' => 'post']) !!}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$product->id}}">
                                                <button style="background: none; border: none;">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$product->id}}">
                                                    <i class="fa fa-search-plus"></i>
                                                </a>

                                                <div class="modal fade bd-example-modal-lg-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-center" id="exampleModalLongTitle">
                                                                    <a href="{{route('pages.product', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug])}}">
                                                                        {{$product->name}}
                                                                    </a>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-5">
                                                                        <img class="img-fluid img-thumbnail" src='{{asset("files/storage/app/{$product->image}")}}'>
                                                                    </div>
                                                                    <div class="col-sm-7 text-left">
                                                                        <table class="table">
                                                                            <tbody>
                                                                            @if($product->old_price)
                                                                                <tr>
                                                                                    <th scope="row"><s>Старая цена:</s></th>
                                                                                    <td><s>{{$product->presentPrice()}} сом</s></td>
                                                                                </tr>
                                                                                <tr class="text-danger">
                                                                                    <th scope="row">Новая цена:</th>
                                                                                    <td>{{$product->presentOldPrice()}} сом</td>
                                                                                </tr>
                                                                            @else
                                                                                <tr>
                                                                                    <th scope="row">Цена:</th>
                                                                                    <td>{{$product->presentPrice()}} сом</td>
                                                                                </tr>
                                                                            @endif
                                                                            <tr>
                                                                                <th scope="row">Код товара:</th>
                                                                                <td>{{$product->kod}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Производство</th>
                                                                                <td>{{$product->country->name}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Бренд:</th>
                                                                                <td>
                                                                                    <a href="{{route('pages.brand', [$product->brand->brandcategory->slug, $product->brand->slug])}}">
                                                                                        {{$product->brand->name}}
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Купить этот товар:</th>
                                                                                <td class="btn-modal-index">
                                                                                    {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="id" value="{{$product->id}}">
                                                                                    <input type="hidden" name="name" value="{{$product->name}}">
                                                                                    @if($product->old_price)
                                                                                        <input type="hidden" name="old_price" value="{{$product->old_price}}">
                                                                                    @else
                                                                                        <input type="hidden" name="price" value="{{$product->price}}">
                                                                                    @endif
                                                                                    <button type="submit" class="btn btn-success btn-lg">
                                                                                        <i class="fas fa-cart-arrow-down"></i> В корзину
                                                                                    </button>
                                                                                    {!! Form::close() !!}
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="new-block">
                            @foreach($products_sale as $product)
                                <div class="card">
                                    <div class="product-image product__thumb">
                                        <a class="index-new">
                                            <img class="card-img-top" src='{{asset("files/storage/app/{$product->image}")}}' alt="Card image cap">
                                            @if($product->new)
                                                <span>новинка</span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <input data-show-caption="false" id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $product->userAverageRating }}" data-size="xs" disabled="">
                                            <a href="{{route('pages.product', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug])}}">
                                                {{str_limit($product->name, 25)}}
                                            </a>
                                        </h5>
                                        <p class="card-text card-text-eco">
                                            @if($product->old_price)
                                                <span class="text-danger lead">{{$product->presentOldPrice()}} сом </span>
                                            @else
                                                <span class="lead">{{$product->presentPrice()}} сом</span>
                                            @endif
                                        </p>
                                        <ul class="list-inline hover-eco">
                                            <li class="list-inline-item">
                                                {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$product->id}}">
                                                <input type="hidden" name="name" value="{{$product->name}}">
                                                @if($product->old_price)
                                                    <input type="hidden" name="old_price" value="{{$product->old_price}}">
                                                @else
                                                    <input type="hidden" name="price" value="{{$product->price}}">
                                                @endif
                                                <button style="background: none; border: none;">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="list-inline-item">
                                                {!! Form::open(['route' => 'wish.store', 'method' => 'post']) !!}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$product->id}}">
                                                <button style="background: none; border: none;">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" data-toggle="modal" data-target=".sale-bd-example-modal-lg-{{$product->id}}">
                                                    <i class="fa fa-search-plus"></i>
                                                </a>

                                                <div class="modal fade sale-bd-example-modal-lg-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-center" id="exampleModalLongTitle">
                                                                    <a href="{{route('pages.product', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug])}}">
                                                                        {{$product->name}}
                                                                    </a>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-5">
                                                                        <img class="img-fluid img-thumbnail" src='{{asset("files/storage/app/{$product->image}")}}'>
                                                                    </div>
                                                                    <div class="col-sm-7 text-left">
                                                                        <table class="table">
                                                                            <tbody>
                                                                            @if($product->old_price)
                                                                                <tr>
                                                                                    <th scope="row"><s>Старая цена:</s></th>
                                                                                    <td><s>{{$product->presentPrice()}} сом</s></td>
                                                                                </tr>
                                                                                <tr class="text-danger">
                                                                                    <th scope="row">Новая цена:</th>
                                                                                    <td>{{$product->presentOldPrice()}} сом</td>
                                                                                </tr>
                                                                            @else
                                                                                <tr>
                                                                                    <th scope="row">Цена:</th>
                                                                                    <td>{{$product->presentPrice()}} сом</td>
                                                                                </tr>
                                                                            @endif
                                                                            <tr>
                                                                                <th scope="row">Код товара:</th>
                                                                                <td>{{$product->kod}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Производство</th>
                                                                                <td>{{$product->country->name}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Бренд:</th>
                                                                                <td>
                                                                                    <a href="{{route('pages.brand', [$product->brand->brandcategory->slug, $product->brand->slug])}}">
                                                                                        {{$product->brand->name}}
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Купить этот товар:</th>
                                                                                <td class="btn-modal-index">
                                                                                    {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="id" value="{{$product->id}}">
                                                                                    <input type="hidden" name="name" value="{{$product->name}}">
                                                                                    @if($product->old_price)
                                                                                        <input type="hidden" name="old_price" value="{{$product->old_price}}">
                                                                                    @else
                                                                                        <input type="hidden" name="price" value="{{$product->price}}">
                                                                                    @endif
                                                                                    <button type="submit" class="btn btn-success btn-lg">
                                                                                        <i class="fas fa-cart-arrow-down"></i> В корзину
                                                                                    </button>
                                                                                    {!! Form::close() !!}
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="center-banner">
        <div class="container-fluid">
            <div class="row justify-content-center">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="new eco-blog">
            <div class="title-new">
                <div>
                    <h2 class="lead">Эко блок</h2>
                </div>
                <div>
                    <p class="lead">
                        <a href="{{route('menu.eco-blog')}}">Все записи эко блока</a>
                    </p>
                </div>
            </div>
            <br>
            <div>
                <div class="new-block">
                    @foreach($blogs as $blog)
                        <div class="card card-block-block">
                            <img class="card-img-top img-fluid img-thumbnail" src='{{asset("files/storage/app/{$blog->image}")}}' alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{route('pages.blog', $blog->slug)}}">{{str_limit($blog->name, 35)}}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="new eco-blog">
            <div class="title-new">
                <div>
                    <h2 class="lead">Акции месяца</h2>
                </div>
                <div>
                    <p class="lead">
                        <a href="#">Все акции</a>
                    </p>
                </div>
            </div>
            <br>
        </div>
    </div>

    <div class="container">
        <div class="black-bk">
            <div class="row justify-content-between">
                <div class="post1 col-sm-3">
                    <img src="{{asset('images/kub.png')}}" class="img-fluid">
                </div>
                <div class="post2 col-sm-3">
                    <img src="{{asset('images/dostavka.png')}}" class="img-fluid">
                    <br>
                    <img src="{{asset('images/dostavka.png')}}" class="img-fluid">
                </div>
                <div class="post3 col-sm-6">
                    <img src="{{asset('images/kub-big.png')}}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="new eco-blog">
            <div class="title-new">
                <div>
                    <h2 class="lead">Эко тесты</h2>
                </div>
                <div>
                    <p class="lead">
                        <a href="#">Пройдем другие тесты здесь?</a>
                    </p>
                </div>
            </div>
            <br>
        </div>
    </div>

    <div class="container">
        <div class="banner">
            <div class="row justify-content-center">
                <div class="col-sm-6 bg-fon-test text-center">
                    <img src="{{asset('images/eco-test.png')}}" class="img-fluid">
                    <h2 class="lead">Какой шампунь <br> выбрать?</h2>
                    <a href="#" class="lead">Начать тест?!</a>
                </div>
                <div class="col-sm-6 bg-fon-test text-center">
                    <img src="{{asset('images/eco-text2.png')}}" class="img-fluid">
                    <h2 class="lead">
                        Выбираем идеальное средство для очищения по типу кожи
                    </h2>
                    <a href="#" class="lead">Начать тест?!</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        $("#input-1").rating();

    </script>
    <script>
        $('.slider-index').slick({
            dots: true,
            infinite: true,
            speed: 500,
            arrows: false,
            fade: true,
            cssEase: 'linear',
            autoplay: true,
            autoplaySpeed: 6000
        });
    </script>
@endsection
