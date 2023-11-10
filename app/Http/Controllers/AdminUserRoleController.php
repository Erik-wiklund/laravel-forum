<?php

namespace App\Http\Controllers;

use App\Models\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRoles = User_role::all();
        return view('admin.pages.user_roles', compact('userRoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.new_User_role');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'roleName' => 'required',
            'roleColor' => 'required',
        ]);

        $userRole = new User_role();
        $userRole->name = $request->roleName;
        $userRole->color = $request->roleColor;


        $userRole->save();
        Session::flash('message', 'User Role created successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userroleId)
    {
        $userrole = User_role::find($userroleId);
        return view('admin.pages.view_user_role', compact(['userrole']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $userroleId)
    {
        $userrole = User_role::find($userroleId);
        return view('admin.pages.edit_user_role', compact(['userrole']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $userroleId)
    {
        $userrole = User_role::find($userroleId);

        if ($request->filled('roleName')) {
            $userrole->name = $request->roleName;
        }
        if ($request->filled('userColor')) {
            $userrole->color = $request->userColor;
        }
        $userrole->save();

        Session::flash('message', 'User Role updated successfully');
        Session::flash('alert-class', 'alert-success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
