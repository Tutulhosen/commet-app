<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_data= Role::latest()->get();
        $permission_data= Permission::latest()->get();
        $form_type='add';
        return view('admin.pages.users.role.index', compact('role_data', 'permission_data', 'form_type'));
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
            'name'          =>'required|unique:roles',
            'permission'    =>'required',
            
        ]);

        Role::create([
            'name'              =>$request->name,
            'slug'              =>Str::slug($request->name),
            'permission'        =>json_encode($request->permission),
        ]);
        return back()->with('success', 'successfully add a new role');
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
        $edit_id=Role::findOrFail($id);
        $role_data= Role::latest()->get();
        $permission_data= Permission::latest()->get();
        $form_type='edit';
        return view('admin.pages.users.role.index', compact('role_data', 'permission_data', 'edit_id', 'form_type'));
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
            'name'          =>'required',
            'permission'    =>'required'
        ]);

        $update_id= Role::findOrFail($id);
        $update_id->update([
            'name'      =>$request->name,
            'permission'    =>json_encode($request->permission)
        ]);
        return redirect()->route('role.index')->with('success-mid' , 'successfully update the rolle data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id= Role::findOrFail($id);
        $delete_id->delete();
        return back()->with('success', 'Delete a role data');
    }
}
