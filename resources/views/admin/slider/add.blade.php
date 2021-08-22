@extends('layouts.dashbord_app')

@section('main_slider')
  open
@endsection

@section('addslider')
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
	    <a class="breadcrumb-item" href="{{ route('slider.index') }}">All Sliders</a>
	    <span class="breadcrumb-item active">Add Slider Form</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Slider Add Form</h4>
				<div class="card-body">
					@if(session('success_status'))
						<div class="alert alert-success">
							{{ session('success_status') }}
						</div>
					@endif
					<form method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
						@csrf
					  	<div class="form-group">
						    <label> Slider Title </label>
						    <input type="text" class="form-control" name="slider_title" placeholder="Enter Slider Title">
						    @error('slider_title')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Slider Sub Title </label>
						    <input type="text" class="form-control" name="slider_sub_title" placeholder="Enter Slider Sub Title">
						    @error('slider_sub_title')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Slider Description </label>
						    <textarea class="form-control" rows="5" name="slider_description" placeholder="Enter Slider Description"></textarea>
						    @error('slider_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Slider Photo </label>
						    <input type="file" class="form-control" name="slider_photo">
						    {{-- @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror --}}
					  	</div>
				  	<button type="submit" class="btn btn-primary">Add New Slider</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>

@endsection
