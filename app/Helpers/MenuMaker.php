<?php

namespace App\Helpers;

class MenuMaker
{
    public function MakeMenu($data, $parent_id){
        $st = $data;
        $info = [];
        foreach ($st->where('parent_id', $parent_id) as $d){
            if(count($st->where('parent_id', $d->id)) > 0){
                $d->children = $this->MakeMenu($data, $d->id);
                array_push($info, [
                    'text' => $d->text,
                    'href' => $d->href,
                    'icon' => $d->icon,
                    'target' => $d->target,
                    'title' => $d->title,
                    'children' => $d->children,
                ]);
            }else{
                array_push($info, [
                    'text' => $d->text,
                    'href' => $d->href,
                    'icon' => $d->icon,
                    'target' => $d->target,
                    'title' => $d->title,
                ]);
            }
        }
        return $info;
    }

}
