<!doctype html>
<html lang="en">
    <head>
        @include('include.link')
        <title>@yield('title') | eco-life</title>
    </head>
    <body>
    <div class="wrapper" id="app">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light top-menus">
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav top-a-size">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('menu.about')}}">О Нас</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('menu.delivery')}}">Доставка</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('menu.eco-blog')}}">Блог</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('menu.payment')}}">Оплата</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('menu.contact')}}">Сотрудничество</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('menu.gallery')}}">Оптом</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-auto">
                    </div>
                    <div class="col col-lg-4">
                        <nav class="navbar navbar-light bg-light top-menus justify-content-end">
                            <form action="{{route('pages.search')}}" class="form-inline form-top-head">
                                <input class="form-control" aria-label="Search" type="search" name="query" placeholder="Найти" required="required" value="{{request()->input('query')}}">
                                @if($errors->has('query'))
                                    <span class="text-danger text-sm-center" style="position:fixed;top:35px;">Минимальное число символов 3!</span>
                                @endif
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="mobile-menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="menu-mob-div">
                    <a class="navbar-brand" href="{{route('pages.index')}}">
                        <img src="{{asset('images/logo.png')}}" class="img-fluid logo-mobile" alt="Responsive image">
                    </a>
                </div>
                <div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @foreach($categories as $category)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{route('pages.category', $category->slug)}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{$category->name}}
                            </a>
                            @if($category->subcategory->first())
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($category->subcategory as $subcat)
                                <a class="dropdown-item" href="{{route('pages.subcategory', [$subcat->category->slug, $subcat->slug])}}">
                                    {{$subcat->name}}
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    <ul class="navbar-nav top-a-size">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('menu.about')}}">О Нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('menu.delivery')}}">Доставка</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('menu.eco-blog')}}">Блог</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('menu.payment')}}">Оплата</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('menu.contact')}}">Сотрудничество</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('menu.gallery')}}">Оптом</a>
                        </li>
                    </ul>
                    <form action="{{route('pages.search')}}" class="form-inline but-mob-top my-2 my-lg-0">
                        <input class="form-control mr-sm-2" aria-label="Search" type="search" name="query" placeholder="Найти" required="required" value="{{request()->input('query')}}">
                        <button style="background: none; border: none;" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <div class="header-bottom-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        @guest
                            <a class="top-head-a text-dark" href="{{route('login')}}">Вход</a><br>
                            @if (Route::has('register'))
                                <a class="top-head-a" href="{{route('register')}}">Регистрация</a>
                            @endif
                            @else
                            <ul class="navbar-nav top-a-size">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="{{route('pages.users.edit')}}">Мой профиль</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                            Выйти
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endguest
                    </div>
                    <div class="col-3 text-right">
                        <a class="top-head-a" href="{{route('wish.index')}}">
                            <i class="fas fa-heart wish"></i> <span>({{$wishCount}})</span><br>
                        </a>
                        <a class="top-head-a" href="{{route('cart.index')}}">
                            <i class="fas fa-shopping-cart"></i> <span>({{ Cart::instance('default')->count() }})</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="row header-bottom-flex">
                    <div class="col-sm-3">
                        <a href="{{route('pages.index')}}">
                            <img src="{{asset('images/logo.png')}}" class="img-fluid" alt="Responsive image">
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <blockquote class="blockquote">
                            <p class="mb-0">
                                <a class="top-head-a" href="">+ 996 (222) 750 075</a>
                            </p>
                            <div class="mb-0">
                                <ul class="list-inline sotset">
                                    <li class="list-inline-item">
                                        <a href="https://www.youtube.com/" target="_blank">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li><li class="list-inline-item">
                                        <a href="https://www.instagram.com/" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </blockquote>
                    </div>
                    <div class="col-sm-3">
                        <ul class="list-inline wish-list">
                            @guest
                                <a href="{{route('login')}}" class="btn btn-success btn-sm btn-green">Вход</a>
                                @if (Route::has('register'))
                                    <a href="{{route('register')}}" class="btn btn-warning btn-sm btn-top-green">Регистрация</a>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link user-login dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{route('pages.users.edit')}}">Мой профиль</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Выйти
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            <p class="mb-0">
                                <i class="fas fa-heart wish"></i>
                                <a class="top-head-a top-zakladki" href="{{route('wish.index')}}">Мои закладки </a>
                                <span class="mb-0">({{$wishCount}})</span>
                            </p>
                        </ul>
                    </div>
                    <div class="col-sm-3 cart">
                        <ul class="list-inline sotset1">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="mb-0 cart-text">
                                @if(Cart::instance('default')->count())
                                    <a href="{{route('cart.index')}}">Корзина ({{ Cart::instance('default')->count() }} eд.)</a>
                                @else
                                    <a href="{{route('cart.index')}}">Корзина</a>
                                @endif
                            </span><br>
                            <span class="podarok">В корзине подарок-сюрприз! :)</span>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-cat">
            <div class="container">
                <ul class="sky-mega-menu sky-mega-menu-anim-scale sky-mega-menu-response-to-icons">
                    @foreach($categories as $category)
                    <li aria-haspopup="true">
                        <a href="{{route('pages.category', $category->slug)}}" class="{{last(request()->segments()) == $category->slug ? 'active' : ''}}">
                            {{$category->name}}
                        </a>
                        <div class="grid-container3">
                            <ul>
                                @foreach($category->subcategory as $subcat)
                                <li aria-haspopup="true">
                                    <a href="{{route('pages.subcategory', [$subcat->category->slug, $subcat->slug])}}">{{$subcat->name}}</a>
                                    <div class="grid-container3">
                                        <ul>
                                            @foreach($subcat->categoryproduct as $catpro)
                                            <li aria-haspopup="true">
                                                <a href="{{route('pages.categoryproduct', [$category->slug, $catpro->subcategory->slug, $catpro->slug])}}">
                                                    {{$catpro->name}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endforeach
                    <li aria-haspopup="true">
                        <a href="{{route('pages.brands')}}" class="{{request()->route()->getName() === 'pages.brands' ? 'active' : ''}}">
                            Производители
                        </a>
                        <div class="grid-container3">
                            <ul>
                                @foreach($brandss as $brandcat)
                                    <li aria-haspopup="true">
                                        <a href="{{route('pages.brandcategory', $brandcat->slug)}}">{{$brandcat->name}}</a>
                                        <div class="grid-container3 grid-3-brand">
                                        <ul>
                                            @foreach($brandcat->brand as $br)
                                            <li aria-haspopup="true">
                                                <a href="{{route('pages.brand', [$br->brandcategory->slug, $br->slug])}}">{{$br->name}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-fluid">
            <div class="container">
                @if(session('message'))
                    <div class="alert alert-primary message" role="alert">
                        {{session('message')}}
                    </div>
                @endif
            </div>
            @yield('content')
        </div>

        <div class="footer-con container-fluid">
            <div class="footer">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-3">
                            <h4 class="title-footer">О компании</h4>
                            <div class="about-footer">
                                <img src="{{asset('images/logo-fooetr.png')}}" class="img-fluid">
                                <p class="lead">
                                    EcoLife – мультбрендовый магазин натуральное и здоровое питание
                                    в Бишкеке для всей семьи
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 footer-sotset">
                            <h4 class="title-footer">Контакты</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="">+996 (0770) 800-688</a></li>
                                <li class="list-group-item"><a href="">+996 (0777) 950-099</a></li>
                                <li class="list-group-item"><a href="">+996 (0770) 554-409</a></li>
                                <li class="list-group-item"><a href="">+996 (0222) 750-075</a></li>
                            </ul>
                            <br>
                            <ul class="list-inline sotset">
                                <li class="list-inline-item">
                                    <a href="https://www.youtube.com/" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li><li class="list-inline-item">
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/" target="_blank">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h4 class="title-footer">Адреса</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span>
                                        <i class="fas fa-map-marker-alt"></i> ул. Московская 150 (пересекает Исанова)
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span>
                                        <i class="fas fa-map-marker-alt"></i> пр. Мира, 58 (пер. Айни)
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span>
                                        <i class="fas fa-map-marker-alt"></i> ул. Юнусалиева 173/4 (мкр.Юг-7,за "Газпром")
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span>
                                        <i class="fas fa-map-marker-alt"></i> ул. Ибраимова 108 (пер.Чуй)
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 footer-sotset">
                            <h4 class="title-footer">Время работы</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><span>08:00 - 18:00</span></li>
                                <li class="list-group-item"><span>08:00 - 18:00</span></li>
                                <li class="list-group-item"><span>08:00 - 18:00</span></li>
                                <li class="list-group-item"><span>08:00 - 18:00</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('include.script')
    </body>
</html>
