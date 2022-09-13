<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counter_data= Counter::latest()->get();
        $form_type= 'add';
        return view('admin.pages.counter.index', compact('form_type', 'counter_data'));
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

        //form validation
       $this->validate($request, [
        'title'                     =>'required',
        'projectNumber'             =>'required',
        'icon'                      =>'required',
    ]);

     Counter::create([
        'title'                    =>$request->title,
        'projectNumber'            =>$request->projectNumber,
        'icon'                     =>$request->icon,
    ]);

    return back()->with('success', 'successfully add a new Counter');
      
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
        $edit_id= Counter::findOrFail($id);
        $counter_data= Counter::latest()->get();
        $form_type= 'edit';
        return view('admin.pages.counter.index', compact('form_type', 'counter_data', 'edit_id'));
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
        $update_id= Counter::findOrFail($id);
        //form validation
        $this->validate($request, [
            'title'                   =>'required',
            'projectNumber'           =>'required',
        ]);

        $update_id->update([
            'title'                  =>$request->title,
            'projectNumber'          =>$request->projectNumber,
            'icon'                   =>$request->icon,
        ]);

        return redirect()->route('counter.index')->with('success-mid', 'successfully update the counter data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dalete_id=Counter::findOrFail($id);
        $dalete_id->delete();
        return back()->with('success-mid', 'Delete the counter');
    }

    public function counterStatusUpdate($id)
    {
        $update_id= Counter::findOrFail($id);
        if ($update_id->status) {
            $update_id->update([
                'status'        =>false,
            ]);
        } else {
            $update_id->update([
                'status'    => true,
            ]);
        }

        return back()->with('success-mid', 'successfully update the status');
        
    }




}
