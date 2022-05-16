<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach($menu->where('parent_id',null) as $m)
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
        @endforeach
    </ul>

</nav>
