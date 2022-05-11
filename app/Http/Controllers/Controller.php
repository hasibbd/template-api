<?php

namespace App\Http\Controllers;

use App\Models\Menu\Menu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $list = Menu::all();
        //$info = $this->MenuMaker($list, null);
        View::share('menu', $list);
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
        return $info;
    }
}
