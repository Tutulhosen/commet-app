<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategotyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_data= Category::latest()->get();
        $form_type='add';
        return view('admin.pages.portfolio.category.index', compact('category_data', 'form_type'));
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
            'name'      =>'required|unique:categories'
        ]);

        Category::create([
            'name'          =>$request->name,
            'slug'          =>Str::slug($request->name),
        ]);
        return back()->with('success', 'successfully add a category');
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
        $edit_id= Category::findOrFail($id);
        $category_data= Category::latest()->get();
        $form_type='edit';
        return view('admin.pages.portfolio.category.index', compact('category_data', 'edit_id', 'form_type'));
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
          $update_id= Category::findOrFail($id);
          $update_id->update([
            'name'      =>$request->name,
            'slug'      => Str::slug($request->name)
          ]);
          return redirect()->route('category.index')->with('success-mid', 'successfully update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id= Category::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-mid', 'Delete the Category');
    }


    /**
     * update category status
     */
    public function categoryStatusUpdate($id)
    {
        $update_id=Category::findOrFail($id);
        if ($update_id->status) {
            $update_id->update([
                'status'  =>false,
            ]);
        } else {
            $update_id->update([
                'status'    =>true,
            ]);
        }
        return back()->with('success-mid', 'successfully update the status');
        
    }




}
