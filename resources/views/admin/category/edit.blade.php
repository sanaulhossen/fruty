@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('category')
  open
@endsection

@section('indexcategory')
  active
@endsection

@section('title')
  Category | Dashbord
@endsection

@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('category.index') }}">Category</a>
	    <span class="breadcrumb-item active">{{ $category_info->category_name }}</span>
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
					<form method="post" action="{{ route('category.update',$category_info->id) }}" enctype="multipart/form-data">
						@csrf
						@method('PATCH')
					  	<div class="form-group">
						    <label> Category Name </label>
						    <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" value="{{ $category_info->category_name }}">
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Category Short Description </label>
						    <textarea class="form-control" name="category_description" placeholder="Enter Category Short Description" rows="4">{{ $category_info->category_description }}</textarea>
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>

					  	<div class="form-group">
						    <label> Category Thumbnail Photo </label>
						    <input type="file" class="form-control" name="category_photo">
						    <img src="{{ asset('dashbord/image/category_image') }}/{{ $category_info->category_photo }}" class="img-fluid" alt="Category Photo">
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
