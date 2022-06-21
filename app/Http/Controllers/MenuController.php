<?php

namespace App\Http\Controllers;

use App\Models\Menu\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Laravel\Lumen\Application
     */
    public function index()
    {
        return view('admin.pages.menu.index');
    }
    public function get()
    {
      $list = Menu::first();
      return response()->json([
          'message' => 'Menu list loaded',
          'data' => json_decode($list)
      ],200);
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
       $check = Menu::first();
       if ($check){
           Menu::find($check->id)->update([
               'menu_list' => json_encode($request->menu_list)
           ]);
       }else{
           $request->menu_id = rand(1,99999);
           Menu::create([
             'menu_list' => json_encode($request->menu_list)
           ]);
       }
        return response()->json([
            'message' => 'Menu list stored',
        ],200);
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
