@extends('layouts.dashbord_app')


@section('product_main')
  open
@endsection

@section('category')
  open
@endsection

@section('addcategory')
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
	    <span class="breadcrumb-item active">Add Category</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Category Add Form</h4>
				<div class="card-body">
					@if(session('success_status'))
						<div class="alert alert-success">
							{{ session('success_status') }}
						</div>
					@endif
					<form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
						@csrf
					  	<div class="form-group">
						    <label> Category Name </label>
						    <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name">
						    @error('category_name')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Category Description </label>
						    <textarea class="form-control" rows="5" name="category_description" placeholder="Enter Category Description"></textarea>
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Category Photo </label>
						    <input type="file" class="form-control" name="category_photo">
						    {{-- @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror --}}
					  	</div>
				  	<button type="submit" class="btn btn-primary">Add New Category</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>

@endsection
