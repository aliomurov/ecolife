<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.index')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('img/logo/logo2.png')}}">
        </div>
        <div class="sidebar-brand-text mx-3">EcoLife</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Панель управления</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Меню
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
           aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Категории</span>
        </a>
        <div id="collapseBootstrap" class="collapse
        {{request()->route()->getName() === 'category.index' ? 'show' : ''}}
        {{request()->route()->getName() === 'subcategory.index' ? 'show' : ''}}
        {{request()->route()->getName() === 'categoryproduct.index' ? 'show' : ''}}"
             aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Категории</h6>
                <a class="collapse-item {{request()->route()->getName() === 'category.index' ? 'active' : ''}}" href="{{route('category.index')}}">
                    Категории
                </a>
                <a class="collapse-item {{request()->route()->getName() === 'subcategory.index' ? 'active' : ''}}" href="{{route('subcategory.index')}}">
                    Под категории
                </a>
                <a class="collapse-item {{request()->route()->getName() === 'categoryproduct.index' ? 'active' : ''}}" href="{{route('categoryproduct.index')}}">
                    Категории продуктов
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap-brand"
           aria-expanded="true" aria-controls="collapseBootstrap-brand">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Бренды</span>
        </a>
        <div id="collapseBootstrap-brand" class="collapse
        {{request()->route()->getName() === 'brandcategories.index' ? 'show' : ''}}
        {{request()->route()->getName() === 'brand.index' ? 'show' : ''}}"
             aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Бренды</h6>
                <a class="collapse-item {{request()->route()->getName() === 'brandcategories.index' ? 'active' : ''}}" href="{{route('brandcategories.index')}}">
                    Категории Брендов
                </a>
                <a class="collapse-item {{request()->route()->getName() === 'brand.index' ? 'active' : ''}}" href="{{route('brand.index')}}">
                    Бренды
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->route()->getName() === 'product.index' ? 'active-bg' : ''}}" href="{{route('product.index')}}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Товары</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->route()->getName() === 'blog.index' ? 'active-bg' : ''}}" href="{{route('blog.index')}}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Эко-блок</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->route()->getName() === 'country.index' ? 'active-bg' : ''}}" href="{{route('country.index')}}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Страны производства</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->route()->getName() === 'comment.index' ? 'active-bg' : ''}}" href="{{route('comment.index')}}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Отзывы <span class="text-danger"> <strong>({{$comments_view_count}})</strong></span></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->route()->getName() === 'order.index' ? 'active-bg' : ''}}" href="{{route('order.index')}}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Заказы <span class="text-danger"> <strong>({{$orders_shipped_count}})</strong></span></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->route()->getName() === 'slider.index' ? 'active-bg' : ''}}" href="{{route('slider.index')}}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Слайдер</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->route()->getName() === 'admin-list.index' ? 'active-bg' : ''}}" href="{{route('admin-list.index')}}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Администраторы</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->route()->getName() === 'user.index' ? 'active-bg' : ''}}" href="{{route('user.index')}}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Пользователи</span>
        </a>
    </li>
    <br>
    <hr class="sidebar-divider">
    <br>
    @yield('category')
</ul>
