<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expertise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expertise_data= Expertise::latest()->get();
        $form_type= 'add';
        return view('admin.pages.expertise.index', compact('expertise_data', 'form_type'));
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
         //validation
       $this->validate($request, [
        'title'                  =>'required',
        'desc'                   =>'required',
        'icon'                   =>'required',
       ]);

        //file upload with image intervention
        if ($request->hasFile('icon')) {
            $file= $request->file('icon');
            $file_name = md5(time() . rand()) . '.' . $file->clientExtension();

            $image= Image::make($file->getRealPath());
            $image->save(storage_path('app/public/expertise/' . $file_name));
       }

       //create data

       Expertise::create([
        'title'      =>$request->title,
        'desc'      =>$request->desc,
        'icon'      =>$file_name,
       ]);

       return back()->with('success', 'successfully add a new expertise');
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
        $edit_id= Expertise::findOrFail($id);
        $expertise_data= Expertise::latest()->get();
        $form_type= 'edit';
        return view('admin.pages.expertise.index', compact('expertise_data', 'form_type', 'edit_id'));
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
        $update_id= Expertise::findOrFail($id);
        //form validation
        $this->validate($request, [
            'title'             =>'required',
            'desc'              =>'required',
            

        ]);

        //photo upload
        if ($request->hasFile('icon')) {
            $file= $request->file('icon');
            $file_name= md5(time().rand()) . '.' . $file->clientExtension();

            //unlink previous photo
            if ($update_id->icon) {
                unlink(storage_path('app/public/expertise/' . $update_id->icon));
            }
            $image= Image::make($file->getRealPath());
            $image->save(storage_path('app/public/expertise/' . $file_name));
        }


        //update data

        if ($request->hasFile('icon')) {
             $update_id->update([
                'title'      =>$request->title,
                'desc'      =>$request->desc,
                'icon'      =>$file_name,
             ]);
        } else {
            $update_id->update([
                'title'      =>$request->title,
                'desc'       =>$request->desc,
            ]);
        }
        
       return redirect()->route('expertise.index')->with('success-mid', 'successfully update the expertise data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id= Expertise::findOrFail($id);
        if ($delete_id->icon) {
           unlink(storage_path('app/public/expertise/' . $delete_id->icon));
        }
        $delete_id->delete();
        return back()->with('success-mid', 'A Expertise data is Deleted');
    }


    /**
     * expertise status update
     */

    public function expertiseStatusUpdate($id)
    {
       $update_id= Expertise::findOrFail($id);
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
