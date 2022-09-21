@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Category Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category Tables</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category Table</h4>
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
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Portfolio</th>
                                        <th>Created_at</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @forelse ($category_data as $category)
                                   
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td>
                                            @forelse ($category->portfolio as $item)
                                                <li>{{$item->title}}</li>
                                            @empty
                                                None
                                            @endforelse
                                        </td>
                                        <td>{{$category->created_at->diffForHumans()}}</td>

                                        @if ($category->status)
                                        <td>
                                            <span class="badge badge-pill badge-success">Published</span> <a class="btn btn-sm btn-dark" style="color: red;" href="{{route('category.status.update', $category->id)}}"><i class="fa fa-times btn_alert"></i></a>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-pill badge-danger">Unpublished</span> <a class="btn btn-sm btn-light" style="color:green" href="{{route('category.status.update', $category->id)}}"><i class="fa fa-check"></i></a>
                                        </td>
                                        @endif

                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-warning" href="{{route('category.edit', $category->id)}}"><i class="fa fa-edit"></i></a>
                                            <form action="{{route('category.destroy', $category->id)}}" class="delete-form" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn_form" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr style="">
                                            <td colspan="6" class="text-center text-danger">No category data found</td>
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
                        <h4 class="card-title">Add Category</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('category.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                                <input name="name" type="text" class="form-control">
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
                        <h4 class="card-title">Edit Category</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('category.update', $edit_id->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Category Name</label>
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