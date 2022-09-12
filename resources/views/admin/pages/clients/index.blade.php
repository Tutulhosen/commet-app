@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Client Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Client Tables</li>
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
                                        <th>Client Name</th>                        
                                        <th>Logo</th>
                                        <th>created_at</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @forelse ($client_data as $client)
                                    
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$client->name}}</td>
                                        <td><img style="height: 42px; width:42px" src="{{url('storage/client/' . $client->logo)}}" alt=""></td>
                                        <td>{{$client->created_at-> diffForHumans()}}</td>
                                        @if ($client->status)
                                        <td>
                                            <span class="badge badge-pill badge-success">Published</span> <a class="btn btn-sm btn-dark" style="color: red;" href="{{route('client.status.update', $client->id)}}"><i class="fa fa-times btn_alert"></i></a>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-pill badge-danger">Unpublished</span> <a class="btn btn-sm btn-light" style="color:green" href="{{route('client.status.update', $client->id)}}"><i class="fa fa-check"></i></a>
                                        </td>
                                        @endif
                                        

                                        
                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-warning" href="{{route('client.edit', $client->id)}}"><i class="fa fa-edit"></i></a>
                                            <form  action="{{route('client.destroy', $client->id)}}" class="delete-form" method="POST">
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
                        <h4 class="card-title">Add Client</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>  Client Name</label>
                                <input name="name" type="text" class="form-control" value="{{old('name')}}">
                            </div>

                            

                            <div class="form-group">
                                <label>Logo</label>

                                <img style="max-width: 100%" id="slider-photo-preview" src="" alt="">
                                <br><br>
                                <input style="display: none" name="logo" type="file" class="form-control" id="photo-icon">
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
                        <h4 class="card-title">Edit Client</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('client.update', $edit_id->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>  Client Name</label>
                                <input name="name" type="text" class="form-control" value="{{$edit_id->name}}">
                            </div>

                            

                            <div class="form-group">
                                <label>Logo</label>

                                <img style="max-width: 100%" id="slider-photo-preview" src="{{url('storage/client/' . $edit_id->logo)}}" alt="">

                                <br><br>
                                
                                <input style="display: none" name="logo" type="file" class="form-control" id="photo-icon">
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