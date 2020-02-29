@extends('layout')

@section('title')
    {{$product->name}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('pages.category', $product->category->slug)}}">{{$product->category->name}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('pages.subcategory', [$product->category->slug, $product->subcategory->slug])}}">{{$product->subcategory->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                </ol>
            </nav>
        </div><br>
        <div class="row cart-title-eco">
            <div class="title-product">
                <h5 class="display-4">{{$product->name}}</h5>
            </div>
        </div><br>
        <div class="row">
            <div class="col">
                <p class="lead text-sm-left poduct-sinle-lead">
                    <span>Производитель: </span> <a href="{{route('pages.brand', [$product->brand->brandcategory->slug, $product->brand->slug])}}">{{$product->brand->name}}</a>
                </p>
            </div>
            <div class="col">
                <p class="lead text-sm-right poduct-sinle-lead poduct-sinle-lead-right">
                    <span>Артикул: </span> {{$product->kod}}
                </p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col single-product-head">
                <form action="{{ route('pages.rating', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug]) }}" method="post">
                    {{ csrf_field() }}
                    <div>
                        <div class="rating row">
                            <div>
                                <input data-show-caption="false" name="rate" id="input-1" class="kv-fa-heart rating-loading" data-size="sm" data-min="0" data-max="5" data-step="1" value="{{ $product->userAverageRating }}">
                                <input type="hidden" name="id" required="" value="{{ $product->id }}">
                            </div>
                            <div class="product-single-rating">
                                <button class="btn-sm btn-success">Голосовать</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col single-product-head single-product-head-2">
                <div>
                    {!! Form::open(['route' => 'wish.store', 'method' => 'post']) !!}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <button style="background: none; border: none;">
                        <span><i class="far fa-heart"></i> Добавить в избранные</span>
                    </button>
                    {!! Form::close() !!}
                </div>
                <div>
                    <p class="lead text-sm-right">
                        <span class="share"><a href="" data-toggle="modal" data-target="#share-1"><i class="fas fa-share-alt"></i> Поделиться</a></span>
                    </p>


<!-- Modal -->
<div class="modal fade" id="share-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Поделиться</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body modal-product-share" id="social-links">
	<ul class="row align-content-center">
		<a class="col" href="https://www.facebook.com/sharer/sharer.php?u={{route('pages.product', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug])}}" id=""><i class="fab fa-facebook share"></i></a>
		<a class="col" href="https://twitter.com/intent/tweet?text=Оцените качество продукта&amp;url={{route('pages.product', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug])}}" id=""><i class="fab fa-twitter share"></i></a>
		<a class="col" href="https://telegram.me/share/url?url={{route('pages.product', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug])}}&amp;title=Отличный продукт на сайте&amp;summary=dОцените качество продукта" id=""><i class="fab fa-telegram-plane share"></i></a>
		<a class="col" href="https://wa.me/?text={{route('pages.product', [$product->category->slug, $product->subcategory->slug, $product->categoryproduct->slug, $product->slug])}}" id=""><i class="fab fa-whatsapp share"></i></a>    
	</ul>
</div>



      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>




                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <div class="image-product">
                    <a class="modal-image" data-toggle="modal" data-target='#exampleModalCenter-{{$product->id}}'>
                        <img src='{{asset("files/storage/app/{$product->image}")}}' class="img-fluid img-thumbnail product-image" alt="Responsive image">
                        <span><i class="fas fa-search-plus"></i></span>
                    </a>
                </div>
                <div class="modal fade" id='exampleModalCenter-{{$product->id}}' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{$product->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src='{{asset("files/storage/app/{$product->image}")}}' class="img-fluid img-thumbnail product-image" alt="Responsive image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row justify-content-between product-gram">
                    <div class="alert alert-success" role="alert">
                        {{$product->gram}} гр. - {{$product->presentPrice()}} сом
                    </div>

                    <div class="alert alert-success" role="alert">
                        @if($product->available)
                            <i class="fas fa-check"></i> В наличии
                        @else
                            <i class="fas fa-check"></i> На заказ
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row justify-content-between product-gram">
                    @if($product->sale)
                        <div class="price-product-eco">
                            <h5 class="old_price"><s>Старая цена: {{$product->presentPrice()}} сом</s></h5>
                            <h2 class="text-danger">Новая цена: {{$product->presentOldPrice()}} сом</h2>
                        </div>
                    @else
                        <div>
                            <h2>Цена: {{$product->price}} сом</h2>
                        </div>
                    @endif
                </div>
                <br>
                <div class="row justify-content-between product-gram">
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
                </div>
                <br>
                <div class="row justify-content-between product-gram">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row">Производитель</th>
                            <td></td>
                            <td></td>
                            <td>{{$product->brand->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Страна производства</th>
                            <td></td>
                            <td></td>
                            <td>{{$product->country->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Вес</th>
                            <td></td>
                            <td></td>
                            <td>{{$product->gram}} гр.</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="row justify-content-between product-gram block-address-delivery">
                    <div class="pg-h6">
                        <h6>Закажите еще на 2000 сом и <br> получите бесплатную доставку!</h6>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <br>
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <nav>
                    <div class="nav nav-tabs nav-a tab-product-single" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">О Товаре</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Состав</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Способ приготовления</a>
                        <a class="nav-item nav-link" id="nav-otziv-tab" data-toggle="tab" href="#nav-otziv" role="tab" aria-controls="nav-otziv" aria-selected="false">Отзывы</a>
                    </div>
                </nav>
                <div class="tab-content tab-product-single-h2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <br>
                        {!! htmlspecialchars_decode($product->description) !!}
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <br>
                        {!! htmlspecialchars_decode($product->structure) !!}
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <br>
                        {!! htmlspecialchars_decode($product->preparation) !!}
                    </div>
                    <div class="tab-pane fade otzivy" id="nav-otziv" role="tabpanel" aria-labelledby="nav-otziv-tab">
                        <br>
                        @if($comments->first())
                            @foreach($comments as $com)
                                <div class="media">
                                    <img src="{{asset('images/1.jpg')}}" class="mr-3" width="8%">
                                    <div class="media-body">
                                        <blockquote class="blockquote">
                                            <p class="mb-0">{{$com->name}}</p>
                                            <footer class="blockquote-footer">
                                                <cite title="Source Title">{{$com->subject}}</cite>
                                            </footer>
                                        </blockquote>
                                        <blockquote class="blockquote text-right">
                                            <footer class="blockquote-footer">{{$com->created_at}}</footer>
                                        </blockquote>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="media">
                                <div class="media-body">
                                    <blockquote class="blockquote">
                                        <p class="mb-0">Нет отзывов на данный продукт</p>
                                    </blockquote>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <p class="lead">
                            Оставить отзыв!
                        </p>
                        <p class="lead text-danger">Ваши отзывы будут опубликованы полсе проверки модераторами!</p>
                        {!! Form::open(['route' => ['pages.comment', $category->slug, $subcategory->slug, $categoryproduct->slug, $product->slug], 'method' => 'put', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Ваше имя') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ваше имя']) !!}
                            @if($errors->has('name'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Ваш email') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ваш email']) !!}
                            @if($errors->has('email'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('subject', 'Введите текст') !!}
                            {!! Form::textarea('subject', null, ['class' => 'form-control', 'placeholder' => 'Введите текст']) !!}
                            @if($errors->has('subject'))
                                <span class="text-danger">Это поле обьязательно!</span>
                            @endif
                        </div>
                        {!! Form::reset('Очистить', ['class' => 'btn btn-primary']) !!}
                        {!! Form::submit('Отправить', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div><br>
        <hr>
        <div class="col-sm-12">
            <h3 class="product-single-second">С ЭТИМ ТОВАРОМ ЧАСТО ПОКУПАЮТ</h3>
            <br>
            <ul class="list-group slick-text-align pk-slick">
                <div class="multiple-items slick-card">
                    @foreach($products as $best)
                        <div class="card">
                            <img class="card-img-top" src='{{asset("files/storage/app/{$best->image}")}}' alt="Card image cap">
                            <div class="card-body">
                                <input data-show-caption="false" id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $best->userAverageRating }}" data-size="xs" disabled="">
                                <a href="{{route('pages.product', [$best->category->slug, $best->subcategory->slug, $best->categoryproduct->slug, $best->slug])}}"><p class="card-text">{{str_limit($best->name, 30)}}</p></a>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$best->id}}">
                                        <input type="hidden" name="name" value="{{$best->name}}">
                                        @if($best->old_price)
                                            <input type="hidden" name="old_price" value="{{$best->old_price}}">
                                        @else
                                            <input type="hidden" name="price" value="{{$best->price}}">
                                        @endif
                                        <button style="background: none; border: none;">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </li>
                                    <li class="list-inline-item">
                                        {!! Form::open(['route' => 'wish.store', 'method' => 'post']) !!}
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$best->id}}">
                                        <button style="background: none; border: none;">
                                            <i class="far fa-heart"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </ul>

            <ul class="list-group slick-text-align mobile-slick">
                <div class="multiple-item slick-card">
                    @foreach($products as $best)
                        <div class="card">
                            <img class="card-img-top" src='{{asset("files/storage/app/{$best->image}")}}' alt="Card image cap">
                            <div class="card-body">
                                <a href="{{route('pages.product', [$best->category->slug, $best->subcategory->slug, $best->categoryproduct->slug, $best->slug])}}"><p class="card-text">{{str_limit($best->name, 30)}}</p></a>
                                <input data-show-caption="false" id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $best->userAverageRating }}" data-size="xs" disabled="">
                                <ul class="list-inline" style="margin-top: 5px;">
                                    <li class="list-inline-item">
                                        {!! Form::open(['route' => 'cart.store', 'method' => 'post']) !!}
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$best->id}}">
                                        <input type="hidden" name="name" value="{{$best->name}}">
                                        @if($best->old_price)
                                            <input type="hidden" name="old_price" value="{{$best->old_price}}">
                                        @else
                                            <input type="hidden" name="price" value="{{$best->price}}">
                                        @endif
                                        <button type="submit" style="background: none; border: none;">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </li>
                                    <li class="list-inline-item">
                                        {!! Form::open(['route' => 'wish.store', 'method' => 'post']) !!}
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$best->id}}">
                                        <button style="background: none; border: none;">
                                            <i class="far fa-heart"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </li>
                                    <li class="list-inline-item">
                                        @if($best->old_price)
                                            <a href="#" class="text-danger">{{$best->presentoldPrice()}} сом</a>
                                        @else
                                            <a href="#">{{$best->presentPrice()}} сом</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </ul>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $("#input-1").rating();

    </script>
@endsection
