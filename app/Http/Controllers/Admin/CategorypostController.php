<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorypostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorypost_data  = Categorypost::latest()->get();
        $form_type          ='add';
        return view('admin.pages.post.category.index', compact('form_type', 'categorypost_data'));
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
            'name'      =>'required|unique:tagposts'
        ]);

        Categorypost::create([
            'name'      =>$request->name,
            'slug'      =>Str::slug($request->name),
        ]);
        return back()->with('success', 'successfully add a new category');
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
        $edit_id                = Categorypost::findOrFail($id);
        $categorypost_data      = Categorypost::latest()->get();
        $form_type              ='edit';
        return view('admin.pages.post.category.index', compact('form_type', 'categorypost_data', 'edit_id'));
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
            'name'      =>'required',
          ]);
          $update_id= Categorypost::findOrFail($id);
          $update_id->update([
            'name'      =>$request->name,
            'slug'      => Str::slug($request->name)
          ]);
          return redirect()->route('categorypost.index')->with('success-mid', 'successfully update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id= Categorypost::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-mid', 'Delete the Tagpost');
    }

    /**
     * category status update
     */

    public function categorypostStatusUpdate($id)
    {
       $update_id= Categorypost::findOrFail($id);
       if ($update_id->status) {
           $update_id->update([
               'status'    =>false,
           ]);
       } else {
          $update_id->update([
           'status'        => true,
          ]);
       }
       return back()->with('success-mid', 'successfully update the status');
       
    }


}
