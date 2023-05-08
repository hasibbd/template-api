<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Configuration\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button class="btn btn-primary btn-sm" onclick="Status(' . $row->id . ')"><i class="fas fa-sync-alt"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show(' . $row->id . ')"><i class="fas fa-pen-square"></i></button>';
                    return $btn;
                })
                ->addColumn('m-action', function ($row) {
                    $btn = '<a class="btn btn-primary btn-sm" href="/assign-menu/' . $row->id . '">Menu Assign</a>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $btn = '<span class="badge badge-pill badge-primary">Active</span>';
                    } else {
                        $btn = '<span class="badge badge-pill badge-danger">Disabled</span>';
                    }
                    return $btn;
                })
                ->addColumn('system_admin', function ($row) {
                    if ($row->is_sys_admin == 1) {
                        $btn = '<span class="badge badge-pill badge-primary">Yes</span>';
                    } else {
                        $btn = '<span class="badge badge-pill badge-danger">No</span>';
                    }
                    return $btn;
                })
                ->rawColumns(['icon', 'status', 'action', 'm-action', 'system_admin'])
                ->make(true);
        }
        return view('admin.pages.configure.role.index');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Role::updateOrCreate([
                'id' => $request->id
            ]
            , [
                'name' => $request->name,
                'is_sys_admin' => isset($request->system_admin) ? 1 : 0,
                'status' => 1,
            ]);

        return response()->json([
            'message' => "New Role Created"
        ], 200);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function status($id)

    {
        $data = Role::find($id);
        if ($data->status) {
            $data = Role::where('id', $id)->update([
                'status' => false
            ]);

            return response()->json([
                'message' => 'Data status update to disabled',
                'data' => $data
            ], 200);

        } else {
            $data = Role::where('id', $id)->update([
                'status' => true
            ]);
            return response()->json([
                'message' => 'Data status update to enable',
                'data' => $data
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $data = Role::find($id);
        if ($data) {
            return response()->json([
                'message' => 'Data Found',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found',
                'data' => $data
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return response()->json([
            'message' => 'Data deleted',
            'data' => []
        ], 202);
    }
}
