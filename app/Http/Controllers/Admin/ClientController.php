<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client_data= Client::latest()->get();
        $form_type= 'add';
        return view('admin.pages.clients.index', compact('client_data', 'form_type'));
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
        'name'                  =>'required',
        'logo'                  =>'required',
       ]);

        //file upload with image intervention
        if ($request->hasFile('logo')) {
            $file= $request->file('logo');
            $file_name = md5(time() . rand()) . '.' . $file->clientExtension();

            $image= Image::make($file->getRealPath());
            $image->save(storage_path('app/public/client/' . $file_name));
       }

       //create data

       Client::create([
        'name'      =>$request->name,
        'logo'      =>$file_name,
       ]);

       return back()->with('success', 'successfully add a new client');




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
        $edit_id= Client::findOrFail($id);
        $client_data= Client::latest()->get();
        $form_type= 'edit';
        return view('admin.pages.clients.index', compact('client_data', 'form_type', 'edit_id'));
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
        $update_id= Client::findOrFail($id);
        //form validation
        $this->validate($request, [
            'name'             =>'required',
            

        ]);

        //photo upload
        if ($request->hasFile('logo')) {
            $file= $request->file('logo');
            $file_name= md5(time().rand()) . '.' . $file->clientExtension();

            //unlink previous photo
            if ($update_id->logo) {
                unlink(storage_path('app/public/client/' . $update_id->logo));
            }
            $image= Image::make($file->getRealPath());
            $image->save(storage_path('app/public/client/' . $file_name));
        }


        //update data

        if ($request->hasFile('logo')) {
             $update_id->update([
                'name'      =>$request->name,
                'logo'      =>$file_name,
             ]);
        } else {
            $update_id->update([
                'name'      =>$request->name,
            ]);
        }
        
       return redirect()->route('client.index')->with('success-mid', 'successfully update the client data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_id= Client::findOrFail($id);
        if ($delete_id->logo) {
           unlink(storage_path('app/public/client/' . $delete_id->logo));
        }
        $delete_id->delete();
        return back()->with('success-mid', 'A Client data is Deleted');
    }


      /**
     * slider status update
     */

    public function clientStatusUpdate($id)
    {
       $update_id= Client::findOrFail($id);
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
