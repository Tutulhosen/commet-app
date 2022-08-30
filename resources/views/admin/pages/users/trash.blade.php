@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Trash User Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Trash User Tables</li>
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
                        <a class="badge badge-pill" style="background-color:rgb(247, 8, 8)" href="{{route('admin-user.index')}}">Active user <i class="fa fa-arrow"></i></a>
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
                                        <td>{{$admin_user->role->name}}</td>
                                        <td><img style="height: 42px; width:42px" src="{{url('avatar.png')}}" alt=""></td>

                                        
                                        

                                        
                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-success btn-alert" href="{{route('admin.user.restore', $admin_user->id)}}">restore</a>


                                            <form  action="{{route('admin-user.destroy', $admin_user->id)}}" class="delete-form" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger " type="submit">permanently delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                    
                                    @empty
                                        <tr style="">
                                            <td colspan="5" class="text-center text-danger">No trash data found</td>
                                        </tr>
                                    @endforelse
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            


        </div>

    
    </div>			
</div>
@endsection