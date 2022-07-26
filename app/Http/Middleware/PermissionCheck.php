<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $per = DB::table('role_has_permissions as rhp')
               ->leftJoin('permissions as p','rhp.permission_id','p.id')
               ->where('p.name', $request->route()->uri)
               ->where('rhp.role_id', Auth::user()->role)
               ->first();
        if ($per){
            return $next($request);
        }
        Auth::logout();
        session()->flush();
        return redirect()->route('/')->withErrors(['msg'=>'<div class="alert alert-danger" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong> Unauthorized Action Performed!
                        </div>']);
    }
}
