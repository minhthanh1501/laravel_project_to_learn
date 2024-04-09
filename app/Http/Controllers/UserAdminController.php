<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserAdminController extends Controller
{
    use DeleteModelTrait;

    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->latest()->paginate(10);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = $this->role->get();

        return view('admin.users.add', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            $user->roles()->attach($request->input('role_id'));
            DB::commit();
            return redirect()->route('users.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage() . '--line: ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        // DB::connection()->enableQueryLog();
        $roles = $this->role->get();
        $user = $this->user->find($id);

        $rolesOfUser = $user->roles;
        // $queries = DB::getQueryLog();
        // dd($queries);
        return view('admin.users.edit', compact('roles', 'user', 'rolesOfUser'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            $user = $this->user->find($id);
            $user->roles()->sync($request->input('role_id'));
            DB::commit();
            return redirect()->route('users.index');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error("message: " . $exception->getMessage() . '--line: ' . $exception->getLine());
        }
    }

    public function delete($id)
    {


        return  $this->deleteModelTrait($id, $this->user);
    }
}
