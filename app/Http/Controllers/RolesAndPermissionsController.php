<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller
{
    public function index($scope)
    {
        $roles = Role::where('scope',$scope)->get();
        return view('super_admin_view.roles_and_permissions.index',compact('scope','roles'));
    }
    public function create($scope)
    {
        $sections = Section::where('section_side','client')->get();
        return view('super_admin_view.roles_and_permissions.form',compact('scope','sections'));
    }
    public function store(Request $request ,$scope)
    {
        $role = Role::create(['name' => $request->role,'scope' => $scope]);
        $prev_name = '';
        $name_arr = [];
        $sections = Section::where('section_side','client')->get();
        $permissions = array_keys($request->permissions);
        $name_of_permissions = [
            'view',
            'create',
            'edit',
            'delete',
        ];
        // foreach ($sections as $section) {
        //     $route = $section->route;
        //     $view_permission_name = $route.'.view';
        //     $create_permission_name = $route.'.create';
        //     $edit_permission_name = $route.'.edit';
        //     $delete_permission_name = $route.'.delete';
        //     if((false !== $found = array_search($view_permission_name,$permissions))
        //         &&(false !== $found = array_search($create_permission_name,$permissions))
        //         &&(false !== $found = array_search($edit_permission_name,$permissions))
        //         &&(false !== $found = array_search($delete_permission_name,$permissions)))
        //         {
        //         foreach ($name_of_permissions as $value) {
        //             $name = $value
        //             if((false !== $found = array_search($view_permission_name,$permissions))
        //         }
        //             array_unset($permissions[$view_permission_name])
        //     }

        // }
        $role->syncPermissions(array_keys($request->permissions));
        toastr()->success(__('Created Successfully'));
        return redirect()->back();

    }
    public function edit($scope,Role $role)
    {
        $role->load('permissions');

        $sections = Section::where('section_side','client')->get();
        return view('super_admin_view.roles_and_permissions.form',compact('role','scope','sections'));
    }
    public function update(Request $request ,$scope,Role $role)
    {
        $role->update(['name' => $request->role,'scope' => $scope]);

        $role->syncPermissions(array_keys($request->permissions));
        toastr()->success(__('updated Successfully'));
        return redirect()->back();
    }
}
