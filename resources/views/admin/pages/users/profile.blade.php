@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="profile-header">
                    <div class="row align-items-center">
                        <div class="col-auto profile-image">
                            <a href="#">
                                @if (Auth::guard('admin')->user()->photo=='avatar.png')
                                <img class="rounded-circle" alt="User Image" src="{{url('avatar.png')}}">
                                @else
                                <img class="rounded-circle" alt="User Image" src="{{url('storage/adminUser/' . Auth::guard('admin')->user()->photo)}}">
                                @endif

                            </a>
                        </div>
                        <div class="col ml-md-n2 profile-user-info">
                            <h4 class="user-name mb-0">{{Auth::guard('admin')->user()->name}}</h4>
                            <h6 class="text-muted">{{Auth::guard('admin')->user()->email}}</h6>
                            <div class="user-Location"><i class="fa fa-map-marker"></i> {{Auth::guard('admin')->user()->location}}</div>
                            <div class="about-text">{{Auth::guard('admin')->user()->role->name}}</div>
                        </div>
                        <div class="col-auto profile-btn">
                            
                            <a href="#" class="btn btn-primary">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="profile-menu">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#password_tab">Password Change</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#photo_tab">Upload your profile photo</a>
                        </li>
                    </ul>
                </div>	
                <div class="tab-content profile-tab-cont">
                    
                    <!-- Personal Details Tab -->
                    <div class="tab-pane fade show active" id="per_details_tab">
                    @include('validate.validate')
                        <!-- Personal Details -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title d-flex justify-content-between">
                                            <span>Personal Details</span> 
                                            <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
                                        </h5>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                            <p class="col-sm-10">{{Auth::guard('admin')->user()->name}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                                            <p class="col-sm-10">{{Auth::guard('admin')->user()->birthday}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                            <p class="col-sm-10">{{Auth::guard('admin')->user()->email}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                            <p class="col-sm-10">{{Auth::guard('admin')->user()->cell}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                            <p class="col-sm-10 mb-0">{{Auth::guard('admin')->user()->location}}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Edit Details Modal -->
                                <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Personal Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{route('admin.profile.edit', Auth::guard('admin')->user()->id)}}" method="POST">
                                                    @csrf
                                                    <div class="row form-row">
                                                        <div class="col-12 ">
                                                            <div class="form-group">
                                                                <label> Name</label>
                                                                <input name="name" type="text" class="form-control" value="{{Auth::guard('admin')->user()->name}}">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Date of Birth</label>
                                                                <div class="cal-icon">
                                                                    <input name="birthday" type="text" class="form-control" @if (Auth::guard('admin')->user()->birthday==NULL)
                                                                    value="DD/ MM/ YY"
                                                                    @else
                                                                    value="{{Auth::guard('admin')->user()->location}}"
                                                                    @endif>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label>Email ID</label>
                                                                <input name="email" type="email" class="form-control" value="{{Auth::guard('admin')->user()->email}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6">
                                                            <div class="form-group">
                                                                <label>Mobile</label>
                                                                <input name="cell" type="text" value="{{Auth::guard('admin')->user()->cell}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <h5 class="form-title"><span>Address</span></h5>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                            <label>Address</label>
                                                                <input name="location" type="text" class="form-control" value="{{Auth::guard('admin')->user()->location}}">
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Edit Details Modal -->
                                
                            </div>

                        
                        </div>
                        <!-- /Personal Details -->

                    </div>
                    <!-- /Personal Details Tab -->
                    
                    <!-- Change Password Tab -->
                    <div id="password_tab" class="tab-pane fade">
                    
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change Password</h5>
                                <div class="row">
                                    <div class="col-md-10 col-lg-6">
                                        <form action="{{route('admin.password.change', Auth::guard('admin')->user()->id)}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input name="old_password" type="password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input name="password" type="password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input name="password_confirmation" type="password" class="form-control">
                                            </div>
                                            <button class="btn btn-primary" type="submit">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Change Password Tab -->

                    <!-- Change photo Tab -->
                    <div id="photo_tab" class="tab-pane fade">
                    
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change Photo</h5>
                                <div class="row">
                                    <div class="col-md-10 col-lg-6">
                                        <form action="{{route('admin.user.profile.photo', Auth::guard('admin')->user()->id)}}" method="POST" enctype="multipart/form-data">

                                            @csrf
                                            <div class="form-group">
                                                <label>Select photo</label>
                                                <input name="photo" type="file" class="form-control">
                                            </div>
                                            
                                            <button class="btn btn-primary" type="submit">Upload Photo</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Change photo Tab -->
                    
                </div>
            </div>
        </div>
    
    </div>			
</div>
@endsection