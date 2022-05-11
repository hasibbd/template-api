<?php

namespace App\Helpers;

use App\Models\Menu\Menu;

class MenuHelper
{
    public static function menu_list()
    {
       /* if(null !== session('menu_list')){
            $menu_list = session('menu_list');
        }else{
            $menu_list = Menu::first();
            session(['menu_list' => $menu_list]);
        }*/
        $menu_list = Menu::first()->menu_list;
     /*   $menu = [];
        foreach (json_decode($menu_list) as $d){
            return $d;
         }*/
        return collect(json_decode($menu_list));
    }
}
