@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Portfolio Tables</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Portfolio Tables</li>
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
                            <table class="table mb-0 data_table" >
                                <thead>
                                    <tr >
                                        <th>id</th>                        
                                        <th>Title</th>                        
                                        <th>Featured Image</th>                        
                                        <th>Gallery</th>
                                        <th>Category</th>
                                        <th>Client Name</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @forelse ($portfolio_data as $portfolio)
                                    
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$portfolio->title}}</td>
                                        <td>
                                            <img style="width: 40px; height:40px" src="{{url('storage/portfolio/featherd/' . $portfolio->featured_image)}}" alt="">
                                        </td>

                                        <td>
                                            <div class="">
                                                @forelse (json_decode($portfolio->gallery) as $item)
                                                    <img height="40px;width:40px" src="{{url('storage/portfolio/gallery/' . $item)}}" alt="">
                                                @empty
                                                    No Data Fount
                                                @endforelse
                                            </div>
                                        </td>

                                        <td>
                                            <ul>
                                                @forelse ($portfolio->category as $item)
                                                <li>{{$item->name}}</li>
                                                @empty
                                                    No Data Fount
                                                @endforelse
                                            </ul>
                                        </td>

                                        

                                        <td>{{$portfolio->client}}</td>

                                        @if ($portfolio->status)
                                        <td>
                                            <span class="badge badge-pill badge-success">Published</span> <a class="btn btn-sm btn-dark" style="color: red;" href="{{route('portfolio.status.update', $portfolio->id)}}"><i class="fa fa-times btn_alert"></i></a>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-pill badge-danger">Unpublished</span> <a class="btn btn-sm btn-light" style="color:green" href="{{route('portfolio.status.update', $portfolio->id)}}"><i class="fa fa-check"></i></a>
                                        </td>
                                        @endif
                                        

                                        
                                        <td style="display: flex;">
                                            <a style="margin-right: 2px" class="btn btn-warning" href="{{route('portfolio.edit', $portfolio->id)}}"><i class="fa fa-edit"></i></a>
                                            <form  action="{{route('portfolio.destroy', $portfolio->id)}}" class="delete-form" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger " type="submit"><i class="fa fa-trash"></i></button>
                                            </form>


                                            
                                        </td>
                                    </tr>
                                   
                                    
                                    @empty
                                        <tr style="">
                                            <td colspan="5" class="text-center text-danger">No portfolio data found</td>
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
                        <h4 class="card-title">Add Portfolio</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('portfolio.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label> Title </label>
                                <input name="name" type="text" class="form-control" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label>Featured Image</label>

                                <img style="max-width: 100%" id="slider-photo-preview" src="" alt="">
                                <br><br>
                                <input style="display: none" name="photo" type="file" class="form-control" id="photo-icon">
                                <label for="photo-icon">
                                    <img style="width:60px; cursor:pointer" src="{{url('image-icon.png')}}" alt="">
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Gallery Image</label>

                                <div class="gallery">

                                </div>
                                <br><br>
                                <input style="display: none" name="gallery[]" multiple type="file" class="form-control" id="gallery_image">
                                <label for="gallery_image">
                                    <img style="width:60px; cursor:pointer"  src="{{url('image-icon.png')}}" alt="">
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Project Description </label>
                                <textarea name="p_desc" id="ckeditor_desc" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label> Project Steps </label>
                                <div id="accordion">

                                    <div class="card portfolio_step">
                                      <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                          <h5 style="cursor: pointer" class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapseOne">STEP 1</h5>
                                        </h5>
                                      </div>
                                  
                                      <div id="collapseOne" class="collapse" data-parent="#accordion">
                                        <div class="card-body">

                                          <div class="m-3">
                                            <label for="">Title</label>
                                            <input name="title[]" type="text" class="form-control">
                                          </div>

                                          <div class="m-3">
                                            <label for="">Description</label>
                                            <textarea name="desc[]"></textarea>
                                          </div>

                                        </div>
                                      </div>
                                    </div>

                                    <div class="card portfolio_step">
                                        <div class="card-header " id="headingOne">
                                          <h5 class="mb-0">
                                            <h5 style="cursor: pointer" class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapseTwo">STEP 2</h5>
                                          </h5>
                                        </div>
                                    
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                          <div class="card-body">
  
                                            <div class="m-3">
                                              <label for="">Title</label>
                                              <input name="title[]" type="text" class="form-control">
                                            </div>
  
                                            <div class="m-3">
                                              <label for="">Description</label>
                                              <textarea name="desc[]"></textarea>
                                            </div>
  
                                          </div>
                                        </div>
                                    </div>

                                    <div class="card portfolio_step">
                                        <div class="card-header" id="headingOne">
                                          <h5 class="mb-0">
                                            <h5 style="cursor: pointer" class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapseThree">STEP 3</h5>
                                          </h5>
                                        </div>
                                    
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                          <div class="card-body">
  
                                            <div class="m-3">
                                              <label for="">Title</label>
                                              <input name="title[]" type="text" class="form-control">
                                            </div>
  
                                            <div class="m-3">
                                              <label for="">Description</label>
                                              <textarea name="desc[]"></textarea>
                                            </div>
  
                                          </div>
                                        </div>
                                    </div>

                                    
                                  </div>
                            </div>

                            <div class="form-group">
                                <label> Category </label>
                                <ul class="cat_list">
                                    @foreach ($category_data as $category)
                                        <li>
                                            <label>
                                                <input name="category[]" value="{{$category->id}}" type="checkbox"> {{$category->name}}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="form-group">
                                <label> Client name </label>
                                <input name="clientName" type="text" class="form-control" value="{{old('clientName')}}">
                            </div>

                            <div class="form-group">
                                <label> Project Type </label>
                                <input name="projectType" type="text" class="form-control" value="{{old('projectType')}}">
                            </div>

                            <div class="form-group">
                                <label>Project Date </label>
                                <input name="project_date" type="date" class="form-control" value="{{old('date')}}">
                            </div>

                            <div class="form-group">
                                <label>Project Link </label>
                                <input name="link" type="text" class="form-control" value="{{old('link')}}">
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
                        <h4 class="card-title">Edit Portfolio</h4>
                    </div>
                    @if (Session::has('success'))
                    @include('validate.validate')
                    @endif

                    @if ($errors->any())
                    @include('validate.validate')
                    @endif

                    <div class="card-body">


                        <form action="{{route('portfolio.update' , $edit_id->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label> Title </label>
                                <input name="name" type="text" class="form-control" value="{{$edit_id->title}}">
                            </div>

                            <div class="form-group">
                                <label>Featured Image</label>
                               
                                <label for="photo-icon">
                                    <img style="max-width: 100%" id="slider-photo-preview" src="{{url('storage/portfolio/featherd/' . $edit_id->featured_image)}}" alt="">
                                </label>
                                <img style="max-width: 100%" id="slider-photo-preview" src="" alt="">
                                <br><br>
                                <input style="display: none" name="photo" type="file" class="form-control" id="photo-icon">
                                <label for="photo-icon">
                                    <img style="width:60px; cursor:pointer" src="{{url('image-icon.png')}}" alt="">
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Gallery Image</label>

                                <div class="gallery">
                                    @foreach (json_decode($edit_id->gallery) as $item)
                                        <img src="{{url('storage/portfolio/gallery/' . $item)}}" alt="">
                                    @endforeach
                                </div>

                                <div class="gallery">

                                </div>
                                <br><br>
                                <input style="display: none" name="gallery[]" multiple type="file" class="form-control" id="gallery_image">
                                <label for="gallery_image">
                                    <img style="width:60px; cursor:pointer"  src="{{url('image-icon.png')}}" alt="">
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Project Description </label>
                                <textarea name="p_desc" id="ckeditor_desc" class="form-control">{{$edit_id->desc}}</textarea>
                            </div>

                            <div class="form-group">
                                <label> Project Steps </label>
                                <div id="accordion">

                                    <div class="card portfolio_step">
                                      <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                          <h5 style="cursor: pointer" class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapseOne">STEP 1</h5>
                                        </h5>
                                      </div>
                                  
                                      <div id="collapseOne" class="collapse" data-parent="#accordion">
                                        <div class="card-body">

                                          <div class="m-3">
                                            <label for="">Title</label>
                                            <input name="title[]" type="text" class="form-control">
                                          </div>

                                          <div class="m-3">
                                            <label for="">Description</label>
                                            <textarea name="desc[]"></textarea>
                                          </div>

                                        </div>
                                      </div>
                                    </div>

                                    <div class="card portfolio_step">
                                        <div class="card-header " id="headingOne">
                                          <h5 class="mb-0">
                                            <h5 style="cursor: pointer" class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapseTwo">STEP 2</h5>
                                          </h5>
                                        </div>
                                    
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                          <div class="card-body">
  
                                            <div class="m-3">
                                              <label for="">Title</label>
                                              <input name="title[]" type="text" class="form-control">
                                            </div>
  
                                            <div class="m-3">
                                              <label for="">Description</label>
                                              <textarea name="desc[]"></textarea>
                                            </div>
  
                                          </div>
                                        </div>
                                    </div>

                                    <div class="card portfolio_step">
                                        <div class="card-header" id="headingOne">
                                          <h5 class="mb-0">
                                            <h5 style="cursor: pointer" class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapseThree">STEP 3</h5>
                                          </h5>
                                        </div>
                                    
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                          <div class="card-body">
  
                                            <div class="m-3">
                                              <label for="">Title</label>
                                              <input name="title[]" type="text" class="form-control">
                                            </div>
  
                                            <div class="m-3">
                                              <label for="">Description</label>
                                              <textarea name="desc[]"></textarea>
                                            </div>
  
                                          </div>
                                        </div>
                                    </div>

                                    
                                  </div>
                            </div>

                            <div class="form-group">
                                <label> Category </label>
                                <ul class="cat_list">
                                    @foreach ($category_data as $category)
                                        <li>
                                            <label>
                                                <input name="category[]" value="{{$category->id}}"  type="checkbox"> {{$category->name}}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="form-group">
                                <label> Client name </label>
                                <input name="clientName" type="text" class="form-control" value="{{$edit_id->client}}">
                            </div>

                            <div class="form-group">
                                <label> Project Type </label>
                                <input name="projectType" type="text" class="form-control" value="{{$edit_id->type}}">
                            </div>

                            <div class="form-group">
                                <label>Project Date </label>
                                <input name="project_date" type="date" class="form-control" value="{{$edit_id->date}}">
                            </div>

                            <div class="form-group">
                                <label>Project Link </label>
                                <input name="link" type="text" class="form-control" value="{{$edit_id->link}}">
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