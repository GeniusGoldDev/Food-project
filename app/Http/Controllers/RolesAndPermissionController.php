<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionController extends Controller
{
    public function index()
    {
        //get all roles except for the first 4 (Admin , StoreOwner, Customer and Delivery Guy)
        $roles = Role::where('id', '>', '4')->with('permissions')->orderBy('created_at', 'DESC')->get();
        $permissions = Permission::get();

        return view('admin.rolesManagement', array(
            'roles' => $roles,
            'permissions' => $permissions,
        ));
    }

    /**
     * @param Request $request
     */
    public function createNewRoleWithPermissions(Request $request)
    {
        // dd($request->all());

        $role = Role::create($request->except(['permission', '_token']));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->givePermissionTo($permissions);

        return redirect()->back()->with(['success' => 'Operation Successful']);

    }

    /**
     * @param $id
     */
    public function editRoleAndPermissions($id)
    {
        $role = Role::where('id', $id)->with('permissions')->firstOrFail();
        $permissions = Permission::get();

        $rolePermissionIds = $role->permissions->pluck('id')->toArray();

        $users = User::role($role->name)->get();

        return view('admin.editRoleAndPermissions', array(
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissionIds' => $rolePermissionIds,
            'users' => $users,
        ));
    }

    /**
     * @param Request $request
     */
    public function updateRoleAndPermissions(Request $request)
    {
        //to prevent default roles (Admin, store, customer, delivery)
        if ($request->id <= 4) {
            echo 'Cannot perform this operation';
            die();
        }

        $role = Role::where('id', $request->id)->firstOrFail();

        $role->name = $request->name;
        $role->save();

        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->syncPermissions($permissions);

        return redirect()->back()->with(['success' => 'Operation Successful']);

    }
}
