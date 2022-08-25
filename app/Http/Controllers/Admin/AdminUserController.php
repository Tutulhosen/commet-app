<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_data= Role::latest()->get();
        $admin_user_data= AdminUser::latest()->get();
        $form_type= 'add';
        return view('admin.pages.index', compact('role_data', 'admin_user_data', 'form_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|unique:admin_users',
            'cell'          => 'required|unique:admin_users',
            'username'      => 'required|unique:admin_users',
            'role'          => 'required',
        ]);

        //generate a random password
        $pass_string = str_shuffle('zxcvbnmasdfghjklqwertyuiop1234567890<>,.?/');
        $pass = substr($pass_string, 10, 10);
        AdminUser::create([
            'name'              =>$request->name,
            'email'             =>$request->email,
            'cell'              =>$request->cell,
            'username'          =>$request->username,
            'role_id'           =>$request->role,
            'photo'             =>'avatar.png',
            'password'          =>Hash::make($pass),
        ]);
        return back()->with('success', 'successfully add a new admin user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_id= AdminUser::findOrFail($id);
        $role_data= Role::latest()->get();
        $admin_user_data= AdminUser::latest()->get();
        $form_type= 'edit';
        return view('admin.pages.index', compact('role_data', 'admin_user_data', 'form_type', 'edit_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'cell'          => 'required',
            'username'      => 'required',
            'role'          => 'required',
        ]);
        $update_data= AdminUser::findOrFail($id);
        $update_data->update([
            'name'              =>$request->name,
            'email'             =>$request->email,
            'cell'              =>$request->cell,
            'username'          =>$request->username,
            'role_id'           =>$request->role,

        ]);

        return redirect()->route('admin-user.index')->with('success-mid', 'successfully update the user data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id= AdminUser::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-mid', 'Delete a User Data');
    }
}
