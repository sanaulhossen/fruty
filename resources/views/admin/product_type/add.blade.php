@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('type')
  open
@endsection

@section('addtype')
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
	    <a class="breadcrumb-item" href="{{ route('productType.index') }}">All Product Type</a>
	    <span class="breadcrumb-item active">Add Product Type</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Product Type Add Form</h4>
				<div class="card-body">
					@if(session('success_status'))
						<div class="alert alert-success">
							{{ session('success_status') }}
						</div>
					@endif
					<form method="post" action="{{ route('productType.store') }}" enctype="multipart/form-data">
						@csrf
					  	<div class="form-group">
						    <label> Product Type Name </label>
						    <input type="text" class="form-control" name="product_type_name" placeholder="Enter Product Type Name">
						    @error('product_type_name')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Type Description </label>
						    <textarea class="form-control" rows="5" name="product_type_description" placeholder="Enter Product Type Description"></textarea>
						    @error('product_type_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
				  	<button type="submit" class="btn btn-primary">Add New Product Type</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>

@endsection
