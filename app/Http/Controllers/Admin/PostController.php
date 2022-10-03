<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Tagpost;
use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_data= Post::latest()->get();
        $categorypost_data= Categorypost::latest()->get();
        $tagpost_data= Tagpost::latest()->get();
        $form_type= 'add';
        return view('admin.pages.post.index', compact('post_data', 'categorypost_data', 'tagpost_data', 'form_type'));
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
            'title'                         =>'required',
            'project_type'                  =>'required',
        ]);

                //photo upload
                if ($request->hasFile('photo')) {
                    $file= $request->file('photo');
                    $file_name= md5(time() . rand()) . '.' . $file->clientExtension();
                    $image = Image::make($file->getRealPath());
                    $image->save(storage_path('app/public/post/featherd/' . $file_name));
                }
        
                //gallery photo upload (multiple photo upload)
        
                $gallery_file=[];
                if ($request->hasFile('gallery')) {
                    $gallery_all= $request->file('gallery');
        
                    
        
                   foreach ($gallery_all as $gallery) {
                    $gallery_name= md5(time() . rand()) . '.' . $gallery->clientExtension();
                    $gallery_image= Image::make($gallery->getRealPath());
                    $gallery_image->save(storage_path('app/public/post/gallery/' . $gallery_name));
        
                    array_push($gallery_file, $gallery_name);
        
        
                   }
                }

                //type management
                $post_type=[
                    'project_type'      =>$request->project_type,
                    'photo'             =>$request->photo,
                    'gallery'           =>$request->gallery,
                    'video'             =>$request->video,
                    'audio'             =>$request->audio,
                    'quote'             =>$request->quote,
                ];

  

               $post= Post::create([
                    'adminuser_id'                  =>Auth::guard('admin')->user()->id,
                    'title'                         =>$request->title,
                    'slug'                          =>Str::slug($request->title),
                    'featured_image'                =>json_encode($post_type),
                    'content'                       =>$request->content,
                ]);

                $post->categorypost()->attach($request->category);
                $post->tagpost()->attach($request->tag);

                return back()->with('success', 'successfully add a new post');
                
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
        $delete_id= Post::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-mid', 'Post is Deleted');
    }

        /**
     * slider status update
     */

    public function postStatusUpdate($id)
    {
       $update_id= Post::findOrFail($id);
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
