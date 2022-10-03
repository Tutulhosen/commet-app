@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Post Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Post Tables</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Post Table</h4>
                    </div>
                    @if (Session::has('success-mid'))
                    @include('validate.validate')
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 data_table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Project Type</th>
                                        <th>Tags</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @forelse ($post_data as $post)
                                    
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>
                                            <ul>
                                                @foreach ($post->categorypost as $item)
                                                    <li>{{$item->name}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @php
                                                $type= json_decode($post->featured_image);
                                                echo $type->project_type
                                            @endphp
                                        </td>

                                        <td>
                                            <ul>
                                                @foreach ($post->tagpost as $item)
                                                    <li>{{$item->name}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                            
                                       
                                        @if ($post->status)
                                        <td>
                                            <span class="badge badge-pill badge-success">Published</span> <a class="btn btn-sm btn-dark" style="color: red;" href="{{route('post.status.update', $post->id)}}"><i class="fa fa-times btn_alert"></i></a>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-pill badge-danger">Unpublished</span> <a class="btn btn-sm btn-light" style="color:green" href="{{route('post.status.update', $post->id)}}"><i class="fa fa-check"></i></a>
                                        </td>
                                        @endif
                                        

                                        
                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-warning" href="{{route('tagpost.edit', $post->id)}}"><i class="fa fa-edit"></i></a>
                                            <form  action="{{route('post.destroy', $post->id)}}" class="delete-form" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger " type="submit"><i class="fa fa-trash"></i></button>
                                            </form>


                                            
                                        </td>
                                    </tr>
                                   
                                    
                                    @empty
                                        <tr style="">
                                            <td colspan="5" class="text-center text-danger">No Post data found</td>
                                        </tr>
                                    @endforelse
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            
            
            @if ($form_type==='add')
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Post</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label> Title </label>
                                <input name="title" type="text" class="form-control" value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label> Project Type </label><br>
                                <select class="form-control" name="project_type" id="project_type_option">
                                    <option value="Standert">Standert</option>
                                    <option value="Gallery">Gallery</option>
                                    <option value="Video">Video</option>
                                    <option value="Audio">Audio</option>
                                    <option value="Quote">Quote</option>
                                </select>
                            </div>

                            <div class="form-group post_photo">
                                <label>Featured Image</label>

                                <img style="max-width: 100%" id="slider-photo-preview" src="" alt="">
                                <br><br>
                                <input style="display: none" name="photo" type="file" class="form-control" id="photo-icon">
                                <label for="photo-icon">
                                    <img style="width:60px; cursor:pointer" src="{{url('image-icon.png')}}" alt="">
                                </label>
                            </div>

                            <div class="form-group post_gallery">
                                <label>Gallery Image</label>

                                <div class="gallery">

                                </div>
                                <br><br>
                                <input style="display: none" name="gallery[]" multiple type="file" class="form-control" id="gallery_image">
                                <label for="gallery_image">
                                    <img style="width:60px; cursor:pointer"  src="{{url('image-icon.png')}}" alt="">
                                </label>
                            </div>

                            <div class="form-group post_video">
                                <label> Video </label>
                                <input name="video" type="text" class="form-control" value="{{old('video')}}">
                            </div>

                            <div class="form-group post_audio">
                                <label> Audio </label>
                                <input name="audio" type="text" class="form-control" value="{{old('audio')}}">
                            </div>

                            <div class="form-group post_quote">
                                <label> Quote </label>
                                <textarea class="form-control" name="quote" ></textarea>
                            </div>

                            <div class="form-group">
                                <label>Project Description </label>
                                <textarea name="p_desc" id="ckeditor_desc" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Post Category </label>
                                <ul class="cat_list">
                                    @foreach ($categorypost_data as $category)
                                        <li>
                                            <label>
                                                <input name="category[]" value="{{$category->id}}" type="checkbox"> {{$category->name}}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="form-group">
                                <label>Project tag </label><br>
                                <select class="form-control select2option" name="tag[]" multiple="multiple">
                                    @foreach ($tagpost_data as $tagpost)
                                    <option value="{{$tagpost->id}}">{{$tagpost->name}}</option>
                                    ...
                                    @endforeach
                                    
                                    
                                </select>
                            </div>

                            

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        
                    </div>
                </div>
            </div>
            @endif



            @if ($form_type==='edit')
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Tag</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('tagpost.update', $edit_id->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Tag Name</label>
                                <input name="name" value="{{$edit_id->name}}" type="text" class="form-control">
                            </div>


                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        
                    </div>
                </div>
            </div>
            @endif
            
        </div>

    
    </div>			
</div>
@endsection