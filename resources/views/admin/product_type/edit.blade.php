@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('type')
  open
@endsection

@section('indextype')
  active
@endsection

@section('title')
  Product Type | Dashbord
@endsection

@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('productType.index') }}">Product Type</a>
	    <span class="breadcrumb-item active">{{ $product_type_info->product_type_name }}</span>
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
					<form method="post" action="{{ route('productType.update',$product_type_info->id) }}">
						@csrf
						@method('PATCH')
					  	<div class="form-group">
						    <label> Tag Name </label>
						    <input type="text" class="form-control" name="product_type_name" placeholder="Enter Tag Name" value="{{ $product_type_info->product_type_name }}">
						    @error('product_type_name')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Tag Description </label>
						    <textarea class="form-control" name="product_type_description" placeholder="Enter Tag Description" rows="4">{{ $product_type_info->product_type_description }}</textarea>
						    @error('product_type_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
				  	<button type="submit" class="btn btn-primary">Product Type Update</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>
@endsection
