<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach($menus as $menu)
            <li class="nav-item @if($menu['children']) menu-open @endif">
                <a href="{{$menu['href']}}" class="nav-link">
                    <i class="nav-icon  {{$menu['icon']}}"></i>
                    <p>
                        {{$menu['text']}} {!! MenuActivator::check($menu['children']) !!}
                        @if($menu['children'])
                        <i class="right fas fa-angle-left"></i>
                        @endif
                    </p>
                </a>
                @if($menu['children'])
                    @foreach($menu['children'] as $menu)
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{$menu['href']}}" class="nav-link">
                                <i class="{{$menu['icon']}} nav-icon"></i>
                                <p>
                                    {{$menu['text']}}
                                    @if($menu['children'])
                                        <i class="right fas fa-angle-left"></i>
                                    @endif
                                </p>
                            </a>
                            @if($menu['children'])
                                @foreach($menu['children'] as $menu)
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <li class="nav-item">
                                            <a href="{{$menu['href']}}" class="nav-link">
                                                <i class="{{$menu['icon']}} nav-icon"></i>
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

       {{-- @foreach($menu->where('parent_id',null) as $m)
            <?php
            $check = $menu->where('parent_id', $m->id)->count();

            ?>
        <li class="nav-item
         @if($check > 0)
        @foreach($menu->where('parent_id', $m->id) as $m2)
        {{ Request::segment(1) == $m2->href  ? 'menu-open' : ''}}
        @endforeach
        @endif
            ">
            <a href="{{$m->href}}" class="nav-link
             @if($check > 0)
              @foreach($menu->where('parent_id', $m->id) as $m2)
                 {{ Request::segment(1) == $m2->href  ? 'active' : ''}}
               @endforeach
            @else
            {{ Request::segment(1) == $m->href  ? 'active' : ''}}
            @endif

                ">
                <i class="nav-icon {{$m->icon}}"></i>
                <p>
                   {{$m->text}}
                    @if($check > 0)
                    <i class="right fas fa-angle-left"></i>
                     @endif
                </p>
            </a>

            @if($check > 0)
            <ul class="nav nav-treeview small">
               @foreach($menu->where('parent_id', $m->id) as $m2)
                    <?php
                    $check2 = $menu->where('parent_id', $m2->id)->count();
                    ?>
                <li class="nav-item">
                    @if($check2 > 0)
                        @foreach($menu->where('parent_id', $m2->id) as $m3)
                            {{ Request::segment(1) == $m3->href  ? 'menu-open' : ''}}
                        @endforeach
                    @endif
                    <a href="{{$m2->href}}" class="nav-link
                       @if($check2 > 0)
                    @foreach($menu->where('parent_id', $m2->id) as $m3)
                    {{ Request::segment(1) == $m3->href  ? 'active' : ''}}
                    @endforeach
                    @else
                    {{ Request::segment(1) == $m2->href  ? 'active' : ''}}
                    @endif
                      ">
                        <i class="nav-icon {{$m2->icon}}"></i>
                        <p> {{$m2->text}}</p>
                    </a>
                </li>
                @endforeach
            </ul>
                @endif
        </li>
        @endforeach--}}
    </ul>

</nav>
