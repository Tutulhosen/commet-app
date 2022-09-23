<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tagpost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagpostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tagpost_data= Tagpost::latest()->get();
        $form_type='add';
        return view('admin.pages.post.tag.index', compact('form_type', 'tagpost_data'));
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

        Tagpost::create([
            'name'      =>$request->name,
            'slug'      =>Str::slug($request->name),
        ]);
        return back()->with('success', 'successfully add a new tag');
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
        $edit_id        = Tagpost::findOrFail($id);
        $tagpost_data   = Tagpost::latest()->get();
        $form_type      ='edit';
        return view('admin.pages.post.tag.index', compact('form_type', 'tagpost_data', 'edit_id'));
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
          $update_id= Tagpost::findOrFail($id);
          $update_id->update([
            'name'      =>$request->name,
            'slug'      => Str::slug($request->name)
          ]);
          return redirect()->route('tagpost.index')->with('success-mid', 'successfully update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id= Tagpost::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-mid', 'Delete the Tagpost');
    }

    /**
     * tag status update
     */

    public function tagpostStatusUpdate($id)
    {
       $update_id= Tagpost::findOrFail($id);
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
