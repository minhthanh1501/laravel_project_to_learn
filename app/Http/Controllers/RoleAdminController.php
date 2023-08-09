<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleAdminController extends Controller
{
    private $role;
    private $permission;
    
    public function __construct(Role $role,Permission $permission) {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index(){
        $roles = $this->role->latest()->paginate(10);

        return view('admin.roles.index',[
            'roles' => $roles
        ]);
    }

    public function create(){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        

         return view('admin.roles.add',[
            'permissionsParent' => $permissionsParent
         ]);
    }

    public function store(Request $request){
        $role = $this->role->create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
        ]);

        $role->permissions()->attach($request->permission_id);

        return redirect()->route('roles.index');
    }
}
