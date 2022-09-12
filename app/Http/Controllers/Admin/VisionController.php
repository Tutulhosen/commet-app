<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vision;
use Illuminate\Http\Request;

class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vision_data= Vision::latest()->get();
        $form_type= 'add';
        return view('admin.pages.vision.index', compact('form_type', 'vision_data'));
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
        'vision'                  =>'required',
        'desc'               =>'required',
    ]);

     Vision::create([
        'vision'                    =>$request->vision,
        'desc'                      =>$request->desc,
    ]);

    return back()->with('success', 'successfully add a new vision');
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
        $edit_id= Vision::findOrFail($id);
        $vision_data= Vision::latest()->get();
        $form_type= 'edit';
        return view('admin.pages.vision.index', compact('form_type', 'vision_data', 'edit_id'));
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
        $update_id= Vision::findOrFail($id);
        //form validation
        $this->validate($request, [
            'vision'                  =>'required',
            'desc'                    =>'required',
        ]);

        $update_id->update([
            'vision'                  =>$request->vision,
            'desc'                    =>$request->desc,
        ]);

        return redirect()->route('vision.index')->with('success-mid', 'successfully update the Vision data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dalete_id=Vision::findOrFail($id);
        $dalete_id->delete();
        return back()->with('success-mid', 'Delete the vision');
    }

        //status update

        public function visionStatusUpdate($id)
        {
            $update_id= Vision::findOrFail($id);
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
