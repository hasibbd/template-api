<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Configuration\Menu;
use App\Models\Configuration\Role;
use App\Models\Configuration\RoleWiseMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $role = Role::find($id);
        $menus_items = Menu::where('parent_id', null)->get();
        $sub_menu_item = Menu::where('parent_id', '!=', null)->get();
        $menus = [];
        foreach ($menus_items as $i){
            $menus [] = [
                'id' =>   $i->id,
                'name' =>   $i->text,
                'url' =>   $i->href,
                'is_checked' => $this->check($i->id, $id),
            ];
        }
        $sub_menus = [];
        foreach ($sub_menu_item as $i){
            $sub_menus [] = [
                'id' =>   $i->id,
                'name' =>   $i->text,
                'url' =>   $i->href,
                'menu_id' =>   $i->parent_id,
                'is_checked' => $this->check($i->id, $id),
            ];
        }
        return view('admin.pages.configure.role-menu.index', compact('menus','sub_menus','role'));
    }

    public function check($menu_id, $role_id){
        return  RoleWiseMenu::where('menu_id', $menu_id)->where('role_id', $role_id)->first() ? true : false;
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
        RoleWiseMenu::where('role_id', $request->id)->delete();
        $menu = [];
        if ($request->menu){
            foreach ($request->menu as $m){
                $menu [] = [
                    'menu_id' => $m,
                    'role_id' => $request->id
                ];
            }
        }
        if ($request->sub_menu){
            foreach ($request->sub_menu as $m){
                $menu [] = [
                    'menu_id' => $m,
                    'role_id' => $request->id
                ];
            }
        }
        RoleWiseMenu::insert($menu);
        return response()->json([
            'message' => "Menu permission updated"
        ], 200);

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
