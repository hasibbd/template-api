<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Configuration\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.pages.menu-list.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $list = Menu::all();
        $info = $this->MenuMaker($list, null);
        return response()->json([
            'data' => json_encode($info),
            'message' => 'Menu loaded'
        ],200);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (count($request->all()) == 0){
            return response()->json([
                'data' => [],
                'message' => 'Menu can not be empty'
            ],404);
        }
        Menu::truncate();
        $st = $this->MenuFormatter($request->menu_data, null);
        if ($st){
            return response()->json([
                'data' => Menu::all(),
                'message' => 'Menu stored'
            ],200);
        }
    }
    public function MenuFormatter($data, $parent_id){
        foreach ($data as $d){
            $st =  Menu::create([
                'text' => $d['text'],
                'href' => $d['href'],
                'icon' => $d['icon'],
                'target' => $d['target'],
                'title' => $d['title'],
                'parent_id' => $parent_id,
            ]);
            if (isset($d['children'])){
                $this->MenuFormatter($d['children'], $st->id);
            }
        }
        return true;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
