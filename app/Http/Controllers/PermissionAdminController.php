<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionAdminController extends Controller
{
    

    public function create(){

        return view('admin.permissions.add');
    }
}
