<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index', [
            'permissions' => Permission::with('roles')->get()
        ]);
    }
}
