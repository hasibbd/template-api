<?php

namespace App\Providers;

use App\Models\Master\UserMenu;
use App\Models\Menu\Menu;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        View::composer(['admin.app.layout'], function ($view) {

            $list = Menu::all();

            $info = $this->MenuMaker($list, null);

            $view->with('menus', $info);
        });
    }
    public function MenuMaker($data, $parent_id){
        $st = $data;
        $info = [];
        foreach ($st->where('parent_id', $parent_id) as $d){
            if(count($st->where('parent_id', $d->id)) > 0){
                $d->children = $this->MenuMaker($data, $d->id);
                array_push($info, [
                    'text' => $d->text,
                    'href' => $d->href,
                    'icon' => $d->icon,
                    'target' => $d->target,
                    'title' => $d->title,
                    'children' => collect($d->children),
                ]);
            }else{
                array_push($info, [
                    'text' => $d->text,
                    'href' => $d->href,
                    'icon' => $d->icon,
                    'target' => $d->target,
                    'title' => $d->title,
                    'children' => []
                ]);
            }
        }
        $permissions = DB::table('role_has_permissions as rhp')
            ->leftJoin('permissions as per','rhp.permission_id','per.id')
            ->where('rhp.role_id', Auth::user()->role)
            ->get();
        $menus = [];
        foreach ($info as $i){
            foreach ($permissions as $p){
                if ($i['href'] == $p->name){
                    $menus [] = $i;
                }
            }
        }
        return $menus;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
