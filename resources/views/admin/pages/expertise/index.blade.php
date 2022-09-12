@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Expertise Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Expertise Tables</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    
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
                                        <th>Icon</th>
                                        <th>created_at</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @forelse ($expertise_data as $expertise)
                                    
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$expertise->title}}</td>
                                        <td><img style="height: 42px; width:42px" src="{{url('storage/expertise/' . $expertise->icon)}}" alt=""></td>
                                        <td>{{$expertise->created_at-> diffForHumans()}}</td>
                                        @if ($expertise->status)
                                        <td>
                                            <span class="badge badge-pill badge-success">Published</span> <a class="btn btn-sm btn-dark" style="color: red;" href="{{route('expertise.status.update', $expertise->id)}}"><i class="fa fa-times btn_alert"></i></a>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-pill badge-danger">Unpublished</span> <a class="btn btn-sm btn-light" style="color:green" href="{{route('expertise.status.update', $expertise->id)}}"><i class="fa fa-check"></i></a>
                                        </td>
                                        @endif
                                        

                                        
                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-warning" href="{{route('expertise.edit', $expertise->id)}}"><i class="fa fa-edit"></i></a>
                                            <form  action="{{route('expertise.destroy', $expertise->id)}}" class="delete-form" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger " type="submit"><i class="fa fa-trash"></i></button>
                                            </form>


                                            
                                        </td>
                                    </tr>
                                   
                                    
                                    @empty
                                        <tr style="">
                                            <td colspan="5" class="text-center text-danger">No expertise data found</td>
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
                        <h4 class="card-title">Add Expertise</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('expertise.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label> Title </label>
                                <input name="title" type="text" class="form-control" value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label> Description </label>
                                <input name="desc" type="text" class="form-control" value="{{old('desc')}}">
                            </div>

                            <div class="form-group">
                                <label>Icon</label>

                                <img style="max-width: 100%" id="slider-photo-preview" src="" alt="">
                                <br><br>
                                <input style="display: none" name="icon" type="file" class="form-control" id="photo-icon">
                                <label for="photo-icon">
                                    <img style="width:60px; cursor:pointer" src="{{url('image-icon.png')}}" alt="">
                                </label>
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
                        <h4 class="card-title">Edit Expertise</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('expertise.update', $edit_id->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>  Title</label>
                                <input name="title" type="text" class="form-control" value="{{$edit_id->title}}">
                            </div>

                            <div class="form-group">
                                <label>  Description</label>
                                <input name="desc" type="text" class="form-control" value="{{$edit_id->desc}}">
                            </div>

                            <div class="form-group">
                                <label>Icon</label>

                                <img style="max-width: 100%" id="slider-photo-preview" src="{{url('storage/expertise/' . $edit_id->icon)}}" alt="">

                                <br><br>
                                
                                <input style="display: none" name="icon" type="file" class="form-control" id="photo-icon">
                                <label for="photo-icon">
                                    <img style="width:60px; cursor:pointer" src="{{url('image-icon.png')}}" alt="">
                                </label>
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