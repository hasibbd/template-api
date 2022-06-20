<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @foreach($menus as $menu)
            <li class="nav-item  {!! MenuActivator::check($menu['children'], Request::segment(1), 'menu-open') !!}">
                <a href="{{$menu['href']}}" class="nav-link  {!! MenuActivator::check($menu['children'],Request::segment(1), 'active') !!} {!! MenuActivator::active($menu['href'], Request::segment(1)) !!}">
                    <i class="nav-icon  {{$menu['icon']}}"></i>
                    <p>
                        {{$menu['text']}}
                        @if($menu['children'])
                            <i class="right fas fa-angle-left"></i>
                        @endif
                    </p>
                </a>
                @if($menu['children'])
                    @foreach($menu['children'] as $menu)
                        <ul class="nav nav-treeview">
                            <li class="nav-item{!! MenuActivator::check($menu['children'], Request::segment(1), 'menu-open') !!}">
                            <a href="{{$menu['href']}}" class="nav-link  {!! MenuActivator::check($menu['children'],Request::segment(1), 'active') !!} {!! MenuActivator::active($menu['href'], Request::segment(1)) !!}">
                                <i class="nav-icon  {{$menu['icon']}}"></i>
                                <p>
                                    {{$menu['text']}}
                                    @if($menu['children'])
                                        <i class="right fas fa-angle-left"></i>
                                    @endif
                                </p>
                            </a>
                            @if($menu['children'])
                                @foreach($menu['children'] as $menu)
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item{!! MenuActivator::check($menu['children'], Request::segment(1), 'menu-open') !!}">
                                            <a href="{{$menu['href']}}" class="nav-link  {!! MenuActivator::check($menu['children'],Request::segment(1), 'active') !!} {!! MenuActivator::active($menu['href'], Request::segment(1)) !!}">
                                                <i class="nav-icon  {{$menu['icon']}}"></i>
                                            <p>
                                                {{$menu['text']}}
                                                @if($menu['children'])
                                                    <i class="right fas fa-angle-left"></i>
                                                @endif
                                            </p>
                                        </a>
                                        </li>
                                    </ul>
                                    @endforeach
                                    @endif
                            </li>
                        </ul>
                    @endforeach
                @endif
            </li>
        @endforeach
    </ul>

</nav>
