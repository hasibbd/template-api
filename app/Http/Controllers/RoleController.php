<?php

namespace App\Http\Controllers;

use App\Models\Menu\Menu;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  Role::orderBy('id','DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button class="btn btn-primary btn-sm" onclick="Status('.$row->id.')"><i class="fas fa-sync-alt"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-pen-square"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->editColumn('status', function($row){
                    if ($row->status == 1){
                        $btn = '<span class="badge badge-pill badge-primary">Active</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-danger">Disabled</span>';

                    }
                    return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.pages.roles-list.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();

        return view('roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::all();
        $has_per = DB::table('role_has_permissions')->where('role_id', $id)->get();
        $data = [];
        foreach ($rolePermissions as $r){
            $is_found = '';
            foreach ($has_per as $hp){
                if ((int)$hp->permission_id == (int)$r->id){
                    $is_found = 'checked';
                }
            }
            array_push($data, [
                'id' =>   $r->id,
                'title' => $r->title,
                'name' => $r->name,
                'parent_menu' => $r->parent_menu,
                'is_checked' => $is_found
            ]);
        }
        return response()->json([
            'message' => 'Role lost',
            'role' => $role,
            'permission' => $data
        ],200);
      //  return view('roles.show', compact('role', 'rolePermissions'));
    }
    public function showAll()
    {
        $rolePermissions = Permission::all();
        $data = [];
        foreach ($rolePermissions as $r){
            $is_found = '';
            array_push($data, [
                'id' =>   $r->id,
                'title' => $r->title,
                'name' => $r->name,
                'parent_menu' => $r->parent_menu,
                'is_checked' => $is_found
            ]);
        }
        return response()->json([
            'message' => 'Role lost',
            'permission' => $data
        ],200);
      //  return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return response()->json([
            'message' => 'Data status update to disabled',
            'role' => $role,
            'permission' => $rolePermissions
        ],200);
      //  return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Role::find($id)->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
    public function status($id){
        $data = Role::find($id);
        if ($data->status){
            $data = Role::where('id', $id)->update([
                'status' => false
            ]);
            return response()->json([
                'message' => 'Data status update to disabled',
                'data' => $data
            ],200);
        }else{
            $data = Role::where('id', $id)->update([
                'status' => true
            ]);
            return response()->json([
                'message' => 'Data status update to enable',
                'data' => $data
            ],200);
        }
    }
    public function storePermission(Request $request){
        if ($request->id){
            Role::where('id', $request->id)->update([
                'name' => $request->role
            ]);
            DB::table('role_has_permissions')->where('role_id', $request->id)->delete();
        }else{
            $st = Role::create([
                'name' => $request->role
            ]);
        }
        $permission = [];
        foreach ($request->checked_item as $per){
            $permission [] = [
                'permission_id' => $per,
                'role_id' => $request->id ? $request->id: $st->id
            ];
        }
        DB::table('role_has_permissions')->insert($permission);
        return response()->json([
            'message' => 'Data updated',
            'data' => []
        ],200);
    }
}
