<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolePermissionsController extends Controller
{
    // all role list
    function index()
    {
        $roles = Role::orderBy('id','desc')->get();
        return response()->json(['roles' => $roles], 200);
    }

    // all permission list
    function permissions()
    {
        $categories = Permission::distinct()->pluck('category');
        $permissionsByCategory = [];
        foreach($categories as $category){
            $permissions = Permission::where('category', $category) 
                                        ->get(['id','name']);
            $permissionsByCategory[$category] = $permissions;
        }
        return response()->json($permissionsByCategory);
    }

    // store new role in database
    function storeRole(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);
        $role = Role::create([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permissions);
        return response()->json([
            'message' => 'Role created successfully'
        ], 200);
    }
    function editRole(Role $role)
    {
        
        $permissions = Permission::all();
        $rolePermissions = $role->permissions;

        return response()->json([
            'role' => $role,
            'permissions' => $permissions,
            'selectedPermissions' => $rolePermissions->pluck('name')
        ]);
    }
    function updateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'permissions' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permissions);
        return response()->json([
            'message' => 'Role updated successfully'
        ], 200);
    }

    // remove role data from database
    function destroy($id)
    {
        $role = Role::where('id',$id);
        $role->delete();
    }
}
