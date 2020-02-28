<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
            <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                         aria-labelledby="searchDropdown">
                        <form class="navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-1 small" placeholder="Введите текст ..."
                                       aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <span class="badge badge-danger badge-counter">{{$orders_shipped_count}}+</span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Новые Заказы
                        </h6>
                        @foreach($orders_shipped as $order)
                        <a class="dropdown-item d-flex align-items-center" href="{{route('order.edit', $order->id)}}">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{$order->created_at}}</div>
                                <span class="font-weight-bold">
                                    Заказ №{{$order->id}} | {{$order->billing_name}}
                                </span>
                            </div>
                        </a>
                        @endforeach
                        <a class="dropdown-item text-center small text-gray-500" href="{{route('order.index')}}">Посмотреть все уведомления</a>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <span class="badge badge-warning badge-counter">{{$comments_view_count}}</span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Отзывы
                        </h6>
                        @foreach($comment_view as $comment)
                        <a class="dropdown-item d-flex align-items-center" href="{{route('comment.edit', $comment->id)}}">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="{{asset('img/man.png')}}" style="max-width: 60px" alt="">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">{{str_limit($comment->subject, 20)}}</div>
                                <div class="small text-gray-500">{{$comment->name}} | {{presentDate($comment->created_at)}}</div>
                            </div>
                        </a>
                        @endforeach
                        <a class="dropdown-item text-center small text-gray-500" href="{{route('comment.index')}}">Прочитать все сообщения</a>
                    </div>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                @if(Auth::guard('admin')->check())
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="{{asset('img/boy.png')}}" style="max-width: 60px">
                        <span class="ml-2 d-none d-lg-inline text-white small">{{Auth::guard('admin')->user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{route('admin-list.edit', Auth::guard('admin')->user()->id)}}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Профиль
                        </a>
                        <div class="dropdown-divider"></div>
                        {!! Form::open(['route'=>'admin.logout']) !!}
                            <button type="submit" class="dropdown-item" style="background: none; border: none;">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Выйти
                            </button>
                        {!! Form::close() !!}
                    </div>
                </li>
                @endif
            </ul>
        </nav>
        <!-- Topbar -->

        @yield('content')

    </div>

    @include('admin.include.footer')
</div>
