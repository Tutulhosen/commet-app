<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider_data= Slider:: latest()->get();
        $form_type= 'add';
        return view('admin.pages.slider.index', compact('slider_data', 'form_type'));
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
        'title'             =>'required',
        'subTitle'          =>'required',
        'photo'             =>'required',
       ]);

       //file upload with image intervention
       if ($request->hasFile('photo')) {
            $file= $request->file('photo');
            $file_name = md5(time() . rand()) . '.' . $file->clientExtension();

            $image= Image::make($file->getRealPath());
            $image->save(storage_path('app/public/slider/' . $file_name));
       }



       //create data
       if ($request->btn_type==false) {
        Slider::create([
            'title'                 =>$request->title,
            'subTitle'              =>$request->subTitle,
            'photo'                 =>$file_name,
           
           ]);
       } else {

        //slider button manage

       $button=[];
       for ($i=0; $i < count($request->btn_title) ; $i++) { 

        array_push($button, [
            'btn_title'   =>$request->btn_title[$i],  
            'btn_link'   =>$request->btn_link[$i],  
            'btn_type'   =>$request->btn_type[$i],  
        ]);

       }
 

        Slider::create([
            'title'                 =>$request->title,
            'subTitle'              =>$request->subTitle,
            'photo'                 =>$file_name,
            'btn'                   =>json_encode($button)
           ]);
       }
       
       

       return back()->with('success', 'Add A New Slider');

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
        $edit_id= Slider::findOrFail($id);
        $slider_data= Slider::latest()->get();
        $form_type= 'edit';
        return view('admin.pages.slider.index', compact('slider_data', 'form_type', 'edit_id'));
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
        $update_id= Slider::findOrFail($id);
        //form validation
        $this->validate($request, [
            'title'             =>'required',
            'subTitle'          =>'required',

        ]);

        //photo upload
        if ($request->hasFile('photo')) {
            $file= $request->file('photo');
            $file_name= md5(time().rand()) . '.' . $file->clientExtension();

            //unlink previous photo
            if ($update_id->photo) {
                unlink(storage_path('app/public/slider/' . $update_id->photo));
            }
            $image= Image::make($file->getRealPath());
            $image->save(storage_path('app/public/slider/' . $file_name));
        }

        //button management
        $button=[];
        for ($i=0; $i < count($request->btn_title); $i++) { 
            array_push($button, [
                'btn_title'   =>$request->btn_title[$i],  
                'btn_link'   =>$request->btn_link[$i],  
                'btn_type'   =>$request->btn_type[$i],
            ]);
        }

        //update data
        if ($request->hasFile('photo')) {
            $update_id->update([
                'title'                 =>$request->title,
                'subTitle'              =>$request->subTitle,
                'photo'                 =>$file_name,
                'btn'                   =>json_encode($button)
            ]);
        } else {
            $update_id->update([
                'title'                 =>$request->title,
                'subTitle'              =>$request->subTitle,

                'btn'                   =>json_encode($button)
            ]);
        }
        
        

        return redirect()->route('slider.index')->with('success-mid', 'successfully update the slider data');





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id= Slider::findOrFail($id);
        $delete_id->delete();
        if ($delete_id->photo) {
            unlink(storage_path('app/public/slider/' . $delete_id->photo));
        }
        return back()->with('success-mid', 'The Slider is Deleted');
    }



    /**
     * slider status update
     */

     public function sliderStatusUpdate($id)
     {
        $update_id= Slider::findOrFail($id);
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
