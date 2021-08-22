@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('tag')
  open
@endsection

@section('addtag')
  active
@endsection

@section('title')
  Tag | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('tag.index') }}">Tags</a>
	    <span class="breadcrumb-item active">Tag</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Tag Add Form</h4>
				<div class="card-body">
					@if(session('success_status'))
						<div class="alert alert-success">
							{{ session('success_status') }}
						</div>
					@endif
					<form method="post" action="{{ route('tag.store') }}">
						@csrf
					  	<div class="form-group">
						    <label> Tag Name </label>
						    <input type="text" class="form-control" name="tag_name" placeholder="Enter Tag Name">
						    @error('category_name')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Tag Description </label>
						    <textarea class="form-control" rows="5" name="tag_description" placeholder="Enter Tag Description"></textarea>
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
				  	<button type="submit" class="btn btn-primary">Add New Tag</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>

@endsection
