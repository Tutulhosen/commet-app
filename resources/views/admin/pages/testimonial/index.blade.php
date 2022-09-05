@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Testimonial Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Testimonial Tables</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Testimonial Table</h4>
                        <a class="badge badge-pill" style="background-color:black" href="">Trash <i class="fa fa-arrow"></i></a>
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
                                        <th>Clint Name</th>                        
                                        <th>Company</th>                        
                                        <th>created_at</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @forelse ($testimonial_data as $testimonial)
                                    
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$testimonial->name}}</td>
                                        <td>{{$testimonial->company}}</td>
                                        <td>{{$testimonial->created_at-> diffForHumans()}}</td>
                                        @if ($testimonial->status)
                                        <td>
                                            <span class="badge badge-pill badge-success">Published</span> <a class="btn btn-sm btn-dark" style="color: red;" href="{{route('testimonial.status.update', $testimonial->id)}}"><i class="fa fa-times btn_alert"></i></a>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-pill badge-danger">Unpublished</span> <a class="btn btn-sm btn-light" style="color:green" href="{{route('testimonial.status.update', $testimonial->id)}}"><i class="fa fa-check"></i></a>
                                        </td>
                                        @endif
                                        

                                        
                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-warning" href="{{route('testimonial.edit', $testimonial->id)}}"><i class="fa fa-edit"></i></a>
                                            <form  action="{{route('testimonial.destroy', $testimonial->id)}}" class="delete-form" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger " type="submit"><i class="fa fa-trash"></i></button>
                                            </form>


                                            
                                        </td>
                                    </tr>
                                   
                                    
                                    @empty
                                        <tr style="">
                                            <td colspan="5" class="text-center text-danger">No slider data found</td>
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
                        <h4 class="card-title">Add Testimonial</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('testimonial.store')}}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label>  Clint Name</label>
                                <input name="name" type="text" class="form-control" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label> Company</label>
                                <input name="company" type="text" class="form-control" value="{{old('company')}}">
                            </div>

                            <div class="form-group">
                                <label> Testimonial</label>
                                <input name="testimonial" type="text" class="form-control" value="{{old('testimonial')}}">
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
                        <h4 class="card-title">Edit Testimonial</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('testimonial.update' , $edit_id->id)}}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>  Clint Name</label>
                                <input name="name" type="text" class="form-control" value="{{$edit_id->name}}">
                            </div>

                            <div class="form-group">
                                <label> Company</label>
                                <input name="company" type="text" class="form-control" value="{{$edit_id->company}}">
                            </div>

                            <div class="form-group">
                                <label> Testimonial</label>
                                <input name="testimonial" type="text" class="form-control" value="{{$edit_id->testimonial}}">
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