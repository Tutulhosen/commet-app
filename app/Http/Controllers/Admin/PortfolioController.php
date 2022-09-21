<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolio_data= Portfolio::latest()->get();
        $category_data= Category::latest()->get();
        $form_type= 'add';
        return view('admin.pages.portfolio.portfolio.index', compact('portfolio_data', 'category_data', 'form_type'));
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
            'name'          =>'required',
            'photo'          =>'required',
        ]);

        //photo upload
        if ($request->hasFile('photo')) {
            $file= $request->file('photo');
            $file_name= md5(time() . rand()) . '.' . $file->clientExtension();
            $image= Image::make($file->getRealPath());
            $image->save(storage_path('app/public/portfolio/featherd/' . $file_name));
        }

        //gallery photo upload (multiple photo upload)

        $gallery_file=[];
        if ($request->hasFile('gallery')) {
            $gallery_all= $request->file('gallery');

            

           foreach ($gallery_all as $gallery) {
            $gallery_name= md5(time() . rand()) . '.' . $gallery->clientExtension();
            $gallery_image= Image::make($gallery->getRealPath());
            $gallery_image->save(storage_path('app/public/portfolio/gallery/' . $gallery_name));

            array_push($gallery_file, $gallery_name);


           }
        }


        //step data manage

        $steps=[];
        if (count($request->title)>0) {
            for ($i=0; $i < count($request->title); $i++) { 
                array_push($steps, [
                    'title'     =>$request->title[$i],
                    'desc'      =>$request->desc[$i],
                ]);
            }
        
        }

        //store data

        $portfolio= Portfolio::create([
            'title'                 =>$request->name,
            'slug'                  =>Str::slug($request->name),
            'featured_image'        =>$file_name,
            'gallery'               =>json_encode($gallery_file),
            'client'                =>$request->clientName,
            'date'                =>$request->project_date,
            'link'                =>$request->link,
            'type'                =>$request->projectType,
            'desc'                =>$request->p_desc,
            'steps'                =>json_encode($steps),
        ]);

        $portfolio->category()->attach($request->category);

        return back()->with('success', 'successfully add a new portfolio');




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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
