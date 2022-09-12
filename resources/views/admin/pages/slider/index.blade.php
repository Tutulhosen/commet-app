@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Slider Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Slider Tables</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Slider Table</h4>
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
                                        <th>Title</th>                        
                                        <th>photo</th>
                                        <th>created_at</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @forelse ($slider_data as $slider)
                                    
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$slider->title}}</td>
                                        <td><img style="height: 42px; width:42px" src="{{url('storage/slider/' . $slider->photo)}}" alt=""></td>
                                        <td>{{$slider->created_at-> diffForHumans()}}</td>
                                        @if ($slider->status)
                                        <td>
                                            <span class="badge badge-pill badge-success">Published</span> <a class="btn btn-sm btn-dark" style="color: red;" href="{{route('slider.status.update', $slider->id)}}"><i class="fa fa-times btn_alert"></i></a>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-pill badge-danger">Unpublished</span> <a class="btn btn-sm btn-light" style="color:green" href="{{route('slider.status.update', $slider->id)}}"><i class="fa fa-check"></i></a>
                                        </td>
                                        @endif
                                        

                                        
                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-warning" href="{{route('slider.edit', $slider->id)}}"><i class="fa fa-edit"></i></a>
                                            <form  action="{{route('slider.destroy', $slider->id)}}" class="delete-form" method="POST">
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
                        <h4 class="card-title">Add Slider</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>  Title</label>
                                <input name="title" type="text" class="form-control" value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label> Sub title</label>
                                <input name="subTitle" type="text" class="form-control" value="{{old('subTitle')}}">
                            </div>

                            <div class="form-group">
                                <label>photo</label>

                                <img style="max-width: 100%" id="slider-photo-preview" src="" alt="">
                                <br><br>
                                <input style="display: none" name="photo" type="file" class="form-control" id="photo-icon">
                                <label for="photo-icon">
                                    <img style="width:60px; cursor:pointer" src="{{url('image-icon.png')}}" alt="">
                                </label>
                            </div>
                            <hr>
                            <div class="form-group slider-btn-opt">

                                
                                
                                <a id="add-slider-button" class="btn btn-sm btn-info" href="#" >Add Slider Button</a>

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
                        <h4 class="card-title">Edit Slider</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('slider.update', $edit_id->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>  Title</label>
                                <input name="title" type="text" class="form-control" value="{{$edit_id->title}}">
                            </div>

                            <div class="form-group">
                                <label> Sub title</label>
                                <input name="subTitle" type="text" class="form-control" value="{{$edit_id->subTitle}}">
                            </div>

                            <div class="form-group">
                                <label>photo</label>

                                <img style="max-width: 100%" id="slider-photo-preview" src="{{url('storage/slider/' . $edit_id->photo)}}" alt="">

                                <br><br>
                                
                                <input style="display: none" name="photo" type="file" class="form-control" id="photo-icon">
                                <label for="photo-icon">
                                    <img style="width:60px; cursor:pointer" src="{{url('image-icon.png')}}" alt="">
                                </label>
                            </div>
                            <hr>
                            <div class="form-group slider-btn-opt">
                                @php
                                    $i=1
                                @endphp
                                @if ($edit_id->btn)
                                @foreach (json_decode($edit_id->btn) as $btn)
                                <div class="btn-opt-area">
                                    <span>Button #{{$i}}</span>
                                    <span  class="badge badge-danger remove_btn" style="margin-left:200px; cursor:pointer">remove</span>
                                    <input name="btn_title[]" class="form-control" type="text" value="{{$btn->btn_title}}">
                                    <input name="btn_link[]" class="form-control" type="text" value="{{$btn->btn_link}}">
                                    <label>Button Color</label>
                                    <br>
                                    <select class="form-control" name="btn_type[]">
                                        <option @if ($btn->btn_type=='btn-light-out')
                                            selected
                                        @endif  value="btn-light-out" >Default</option>
                                        <option @if ($btn->btn_type=='btn-color btn-full')
                                            selected
                                        @endif value="btn-color btn-full" >Red</option>
                                    </select>
                                </div>
                                @endforeach
                                
                                @endif
                                @php
                                    $i++
                                @endphp
                                
                                <a id="add-slider-button" class="btn btn-sm btn-info" href="#" >Add Slider Button</a>

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