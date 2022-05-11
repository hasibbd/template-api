<nav class="mt-2">
{{--    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{ Request::segment(1) == 'dashboard'  ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>

        </li>
        <li class="nav-item">
            <a href="{{url('user-list')}}" class="nav-link {{ Request::segment(1) == 'user-list'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>User List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('menu-list')}}" class="nav-link {{ Request::segment(1) == 'menu-list'  ? 'active' : ''}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Menu List</p>
            </a>
        </li>
    </ul>--}}

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
       @foreach($menu->where('parent_id', null) as $m)
           <?php
            $c = count($menu->where('parent_id', $m->id));
            ?>
        <li class="nav-item
       <?php
        if($c > 0){
            foreach($menu->where('parent_id', $m->id) as $m2){
                echo  Request::segment(1) == $m2['href']  ? 'menu-is-opening menu-open' : '';
            }
        }
        ?>
         ">
         <a href="{{url($m['href'])}}" class="nav-link
{{ Request::segment(1) == $m['href']  ? 'active' : ''}}
         <?php
         if($c > 0){
             foreach($menu->where('parent_id', $m->id) as $m2){
                 echo  Request::segment(1) == $m2['href']  ? 'active' : '';
             }
         }
         ?>
             ">
                <i class="nav-icon {{$m['icon']}}"></i>
                <p>
                   {{$m['text']}}
                    @if($c > 0)
                    <i class="fas fa-angle-left right"></i>
                     @endif
                </p>
            </a>
          @if($c > 0)
                <ul class="nav nav-treeview" style="display: none;">
                @foreach($menu->where('parent_id', $m->id) as $m2)
                    <li class="nav-item">
                        <a href="{{url($m2['href'])}}" class="nav-link {{ Request::segment(1) == $m2['href']  ? 'active' : ''}}">
                            <i class="nav-icon {{$m2['icon']}}"></i>
                            <p>
                                {{$m2['text']}}
                            </p>
                        </a>
                    </li>
                    @endforeach
                </ul>
            @endif
        </li>
        @endforeach
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-search"></i>
                <p>
                    Search
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="pages/search/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Simple Search</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/search/enhanced.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Enhanced</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
