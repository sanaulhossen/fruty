@extends('layouts.dashbord_app')

@section('main_slider')
  open
@endsection

@section('indexslider')
  active
@endsection

@section('title')
  Slider | Dashbord
@endsection

@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('slider.index') }}">Slider</a>
	    <span class="breadcrumb-item active">{{ $slider_info->slider_title }}</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-8 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Category Edit Form</h4>
				<div class="card-body">
					@if(session('success_status'))
						<div class="alert alert-success">
							{{ session('success_status') }}
						</div>
					@endif
					<form method="post" action="{{ route('slider.update',$slider_info->id) }}" enctype="multipart/form-data">
						@csrf
						@method('PATCH')
					  	<div class="form-group">
						    <label> Category Name </label>
						    <input type="text" class="form-control" name="slider_title" placeholder="Enter Category Name" value="{{ $slider_info->slider_title }}">
						    @error('slider_title')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Category Name </label>
						    <input type="text" class="form-control" name="slider_sub_title" placeholder="Enter Category Name" value="{{ $slider_info->slider_sub_title }}">
						    @error('slider_sub_title')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Category Short Description </label>
						    <textarea class="form-control" name="slider_description" placeholder="Enter Category Short Description" rows="4">{{ $slider_info->slider_description }}</textarea>
						    @error('slider_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>

					  	<div class="form-group">
						    <label> Category Thumbnail Photo </label>
						    <input type="file" class="form-control" name="slider_photo">
						    <img src="{{ asset('dashbord/image/slider_image') }}/{{ $slider_info->slider_photo }}" class="img-fluid" alt="Category Photo">
						    {{-- @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror --}}
					  	</div>
				  	<button type="submit" class="btn btn-primary">Update Category</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>

@endsection
