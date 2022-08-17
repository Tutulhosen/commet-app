@extends('admin.layout.app')

@section('main-content')
<div class="page-wrapper">
			
    <div class="content container-fluid">
        
        <!-- Page Header -->
        @include('admin.pages.pageheader')
        <!-- /Page Header -->

        {{-- counter part  --}}
        @include('admin.pages.counter')


        {{-- card header part  --}}
        @include('admin.pages.cardheader')




    </div>			
</div>
@endsection