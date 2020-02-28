<div class="menu-cat">
    <nav class="container">
        <ul class="top-menu">
            @foreach($categories as $category)
                <li>
                    <a href="{{route('pages.category', $category->slug)}}" class="dropdown {{last(request()->segments()) == $category->slug ? 'active' : ''}}">
                        {{$category->name}}
                    </a>
                    @if($category->subcategory->first())
                        <ul class="submenu col-sm-12">
                            <li class="col-sm-4 cat-pad-none">
                                <ul>
                                    @foreach($category->subcategory as $subcat)
                                        <li class="text-left">
                                            <a class="cat" href="{{route('pages.subcategory', [$subcat->category->slug, $subcat->slug])}}">
                                                {{$subcat->name}}
                                            </a>
                                            <ul class="submenu-catpro">
                                                @foreach($subcat->categoryproduct as $catpro)
                                                    <li>
                                                        <a href=""> <i class="fas fa-hand-point-right"></i> {{$catpro->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="col-sm-4 cat-pad-none">
                                <div class="hide">
                                    Категории
                                </div>
                            </li>
                            <li class="col-sm-4">
                                <ul>
                                    <li>
                                        <a href="" class="link-image">
                                            <img src='{{asset("files/storage/app/{$category->image}")}}' alt="img">
                                        </a>
                                    </li>
                                    <li><h3 class="image-header">{{$category->name}}</h3></li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                </li>
            @endforeach
            <li>
                <a href="{{route('pages.brands')}}" class="dropdown {{request()->route()->getName() === 'pages.brands' ? 'active' : ''}}">
                    Производители
                </a>
                <ul class="submenu col-sm-12">
                    <li class="col-sm-4 cat-pad-none">
                        <ul>
                            @foreach($brandss as $brand)
                                <li class="text-left">
                                    <a class="cat" href="{{route('pages.brand', [$brand->slug])}}">
                                        {{$brand->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="col-sm-4 cat-pad-none">
                        <div class="hide">
                            Категории
                        </div>
                    </li>
                    <li class="col-sm-4">
                        <ul>
                            <li>
                                <a href="" class="link-image">

                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>



<nav class="container">
    <ul class="top-menu">
        @foreach($categories as $category)
            <li>
                <a href="{{route('pages.category', $category->slug)}}" class="dropdown {{last(request()->segments()) == $category->slug ? 'active' : ''}}">
                    {{$category->name}}
                </a>
                @if($category->subcategory->first())
                    <ul class="submenu col-sm-8">
                        <li class="col-sm-6 cat-pad-none">
                            <ul>
                                @foreach($category->subcategory as $subcat)
                                    <li class="text-left">
                                        <a class="cat" href="{{route('pages.subcategory', [$subcat->category->slug, $subcat->slug])}}">
                                            {{$subcat->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="col-sm-6">
                            <ul>
                                <li>
                                    <a href="" class="link-image">
                                        <img src='{{asset("files/storage/app/{$category->image}")}}' alt="img">
                                    </a>
                                </li>
                                <li><h3 class="image-header">{{$category->name}}</h3></li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </li>
        @endforeach
        <li>
            <a href="{{route('pages.brands')}}" class="dropdown {{request()->route()->getName() === 'pages.brands' ? 'active' : ''}}">
                Производители
            </a>
            <ul class="submenu submenu-brand col-sm-6">
                <li class="col-sm-12 cat-pad-none">
                    <ul>
                        @foreach($brandss as $brand)
                            <li class="text-center">
                                <a class="cat" href="{{route('pages.brand', [$brand->slug])}}">
                                    {{$brand->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</nav>
