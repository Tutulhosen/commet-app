@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Permission Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Permission Tables</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Permission Table</h4>
                    </div>
                    @if (Session::has('success-mid'))
                    @include('validate.validate')
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 data_table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Permissions</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @forelse ($role_data as $role)
                                   
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <ul>
                                                @forelse (json_decode($role->permission) as $item)
                                                    <li>{{$item}}</li>
                                                @empty
                                                    
                                                @endforelse
                                            </ul>
                                        </td>
                                        <td>{{$role->created_at->diffForHumans()}}</td>
                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-warning" href="{{route('role.edit', $role->id)}}"><i class="fa fa-edit"></i></a>
                                            <form action="{{route('role.destroy', $role->id)}}" class="delete-form" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn_form" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr style="">
                                            <td colspan="6" class="text-center text-danger">No role data found</td>
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
                        <h4 class="card-title">Add Role</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('role.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Role Name</label>
                                <input name="name" type="text" class="form-control">
                            </div>

                            <div>
                                <label for="">Select  Permission</label>
                                <ul style="list-style: none; padding-left:0px">
                                    @forelse ($permission_data as $permission)
                                    <li>
                                        <label for=""><input type="checkbox" name="permission[]" value="{{$permission->name}}"> {{$permission->name}}</label>
                                    </li>
                                    @empty
                                        <ul>
                                            <li>No record found</li>
                                        </ul>
                                    @endforelse
                                    
                                </ul>
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
                        <h4 class="card-title">Edit Role</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('role.update', $edit_id->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Role Name</label>
                                <input name="name" value="{{$edit_id->name}}" type="text" class="form-control">
                            </div>

                            <div>
                                <label for="">Select  Permission</label>
                                <ul style="list-style: none; padding-left:0px">
                                    @forelse ($permission_data as $permission)
                                    <li>
                                        <label for=""><input type="checkbox" name="permission[]" @if (in_array($permission->name, json_decode($edit_id->permission)))
                                            checked
                                        @endif value="{{$permission->name}}"> {{$permission->name}}</label>
                                    </li>
                                    @empty
                                        <ul>
                                            <li>No record found</li>
                                        </ul>
                                    @endforelse
                                    
                                </ul>
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