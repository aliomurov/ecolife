@extends('layout')

@section('title')
    Корзина
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Корзина</li>
                </ol>
            </nav>
        </div><br>

        @if(Cart::count() > 0)
            <div class="row cart-title-eco">
                <div class="title-product">
                    <h5 class="display-4">Корзина ({{ Cart::instance('default')->count() }} eд.)</h5>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    <div class="table-content wnro__table table-responsive">
                        <table>
                            <thead class="lead">
                            <tr>
                                <th>Картинка</th>
                                <th>Наименование товара</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                                <th>Всего к оплате</th>
                                <th>Удалить</th>
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
                                            <span class="amount">{{$item->model->presentOldPrice()}} сом</span>
                                        </td>
                                    @else
                                        <td class="product-price">
                                            <span class="amount">{{$item->model->presentPrice()}} сом</span>
                                        </td>
                                    @endif
                                    <td class="product-quantity">
                                        <input class="quantity" type="number" placeholder="{{$item->qty}}" data-id="{{ $item->rowId }}" value="{{$item->qty}}">
                                    </td>
                                    @if($item->model->presentOldPrice())
                                        <td class="product-subtotal">{{presentOldPrice($item->subtotal)}} сом</td>
                                    @else
                                        <td class="product-subtotal">{{presentPrice($item->subtotal)}} сом</td>
                                    @endif
                                    <td class="product-remove">
                                        {!! Form::open(['route' => ['cart.destroy' , $item->rowId], 'method' => 'post', 'files' => true]) !!}
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" data-toggle="tooltip" title="Удалить">
                                            <i class="fa fa-times-circle"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br>
            <div class="row justify-content-end cart-footer-blok">
                <div class="col-sm-8">
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
                <div class="col-sm-4 col-sm-offset-8">
                    <table class="table table-bordered table-cart-eco">
                        <tbody>
                        <tr>
                            <td class="text-right">
                                <strong>Итого:</strong>
                            </td>
                            <td class="text-right">{{presentPrice(Cart::subtotal())}} сом</td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                <strong>Комиссия:</strong>
                            </td>
                            <td class="text-right">{{presentPrice(Cart::tax())}} сом</td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                <strong>Всего к оплате:</strong>
                            </td>
                            <td class="text-right">{{presentPrice(Cart::total())}} сом</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-sm-4 col-sm-offset-8">
                    <a href="{{route('checkout.index')}}" class="btn btn-info">Оформить</a>
                </div>
            </div>
        @else
            <div class="row cart-title-eco">
                <div class="title-product">
                    <h5 class="display-4">В корзине пусто</h5>
                </div>
            </div><br>
        @endif
    </div>
@endsection

@section('script')
    <script src="{{asset('files/public/js/app.js')}}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value
                    })
                        .then(function (response) {
                            window.location.href = '{{ route('cart.index') }}';
                            /*console.log(response);*/
                        })
                        .catch(function (error) {
                            /*console.log(error);*/
                            window.location.href = '{{ route('cart.index') }}';
                        });
                })
            })
        })();
    </script>
@endsection
