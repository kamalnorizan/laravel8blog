<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.index', compact('users','roles','permissions'));
    }

    public function assignpermissiontorole(Request $request)
    {
        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permission_id);

        return back();
    }

    public function assignroletouser(Request $request)
    {
        $user=User::find($request->user_id);
        $user->syncRoles($request->role_id);
        return back();
    }
}
