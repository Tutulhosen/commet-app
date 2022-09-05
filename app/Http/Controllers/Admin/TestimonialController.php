<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonial_data= Testimonial::latest()->get();
        $form_type= 'add';
        return view('admin.pages.testimonial.index', compact('form_type', 'testimonial_data'));
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
            'name'                  =>'required',
            'company'               =>'required',
            'testimonial'           =>'required',
        ]);

        Testimonial::create([
            'name'                  =>$request->name,
            'company'               =>$request->company,
            'testimonial'           =>$request->testimonial,
        ]);

        return back()->with('success', 'successfully add a new testimonial');
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
        $edit_id= Testimonial::findOrFail($id);
        $testimonial_data= Testimonial::latest()->get();
        $form_type= 'edit';
        return view('admin.pages.testimonial.index', compact('form_type', 'testimonial_data', 'edit_id'));
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
        $update_id= Testimonial::findOrFail($id);
        //form validation
        $this->validate($request, [
            'name'                  =>'required',
            'company'               =>'required',
            'testimonial'           =>'required',
        ]);

        $update_id->update([
            'name'                  =>$request->name,
            'company'               =>$request->company,
            'testimonial'           =>$request->testimonial,
        ]);

        return redirect()->route('testimonial.index')->with('success-mid', 'successfully update the Testimonial data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dalete_id=Testimonial::findOrFail($id);
        $dalete_id->delete();
        return back()->with('success-mid', 'Delete the testimonial');
    }



    //status update

    public function statusUpdate($id)
    {
        $update_id= Testimonial::findOrFail($id);
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
