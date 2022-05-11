<?php

namespace App\Helpers;

use App\Models\Menu\Menu;

class MenuHelper
{
    public static function menu_list()
    {
        $list = Menu::all();
        $info =  (new MenuMaker)->MakeMenu($list, null);
        return $info;
    }
}
