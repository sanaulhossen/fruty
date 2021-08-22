@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('tag')
  open
@endsection

@section('indextag')
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
	    <a class="breadcrumb-item" href="{{ route('tag.index') }}">Tag</a>
	    <span class="breadcrumb-item active">{{ $tag_info->tag_name }}</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-8 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Tag Edit Form</h4>
				<div class="card-body">
					@if(session('success_status'))
						<div class="alert alert-success">
							{{ session('success_status') }}
						</div>
					@endif
					<form method="post" action="{{ route('tag.update',$tag_info->id) }}">
						@csrf
						@method('PATCH')
					  	<div class="form-group">
						    <label> Tag Name </label>
						    <input type="text" class="form-control" name="tag_name" placeholder="Enter Tag Name" value="{{ $tag_info->tag_name }}">
						    @error('tag_name')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Tag Description </label>
						    <textarea class="form-control" name="tag_description" placeholder="Enter Tag Description" rows="4">{{ $tag_info->tag_description }}</textarea>
						    @error('tag_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
				  	<button type="submit" class="btn btn-primary">Update Tag</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>
<!-- ########## END: MAIN PANEL ########## -->
@endsection
