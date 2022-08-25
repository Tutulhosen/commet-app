@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Admin User Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Admin User Tables</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Admin User Table</h4>
                    </div>
                    @if (Session::has('success-mid'))
                    @include('validate.validate')
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Cell</th>
                                        <th>Role</th>
                                        <th>photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($admin_user_data as $admin_user)
                                    @if ($admin_user->name != 'Provider')
                                    <tr>
                                        <td>{{$admin_user->name}}</td>
                                        <td>{{$admin_user->username}}</td>
                                        <td>{{$admin_user->cell}}</td>
                                        <td>{{$admin_user->role}}</td>
                                        <td>{{$admin_user->photo}}</td>

                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-warning" href="{{route('admin-user.edit', $admin_user->id)}}"><i class="fa fa-edit"></i></a>
                                            <form  action="{{route('admin-user.destroy', $admin_user->id)}}" class="delete-form" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger " type="submit"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                    
                                    @empty
                                        <tr style="">
                                            <td colspan="5" class="text-center text-danger">No admin user data found</td>
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
                        <h4 class="card-title">Add admin User</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('admin-user.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>  Name</label>
                                <input name="name" type="text" class="form-control" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label> Email</label>
                                <input name="email" type="text" class="form-control" value="{{old('email')}}">
                            </div>

                            <div class="form-group">
                                <label> User Name</label>
                                <input name="username" type="text" class="form-control" value="{{old('username')}}">
                            </div>
                            
                            <div class="form-group">
                                <label> Cell</label>
                                <input name="cell" type="text" class="form-control" value="{{old('cell')}}">
                            </div>



                            <div class="form-group">
                                <label> Role</label>
                                <select name="role" id="" class="form-control">
                                    <option value="">--select--</option>
                                    @foreach ($role_data as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
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
                        <h4 class="card-title">Edit admin User</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if (Session::has('success-mid'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('admin-user.update', $edit_id->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>  Name</label>
                                <input name="name" type="text" class="form-control" value="{{$edit_id->name}}">
                            </div>

                            <div class="form-group">
                                <label> Email</label>
                                <input name="email" type="text" class="form-control" value="{{$edit_id->email}}">
                            </div>

                            <div class="form-group">
                                <label> User Name</label>
                                <input name="username" type="text" class="form-control" value="{{$edit_id->username}}">
                            </div>
                            
                            <div class="form-group">
                                <label> Cell</label>
                                <input name="cell" type="text" class="form-control" value="{{$edit_id->cell}}">
                            </div>



                            <div class="form-group">
                                <label> Role</label>
                                <select name="role" id="" class="form-control">
                                    <option value="">--select--</option>
                                    @foreach ($role_data as $role)
                                    <option  @if (json_decode($role->name)==$edit_id->role)
                                        selected
                                    @endif value="{{$role->id}}">{{$role->name}}</option>
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
            
        </div>

    
    </div>			
</div>
@endsection