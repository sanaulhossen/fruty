@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('product')
  open
@endsection

@section('addproduct')
  active
@endsection

@section('title')
  Product | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('product.index') }}">Product</a>
	    <span class="breadcrumb-item active">Product Add</span>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-8 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Product Add Form</h4>
				<div class="card-body">
					@if(session('product_status'))
						<div class="alert alert-success">
							{{ session('product_status') }}
						</div>
					@endif

					<form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
						@csrf
					  	<div class="form-group">
						    <label> Category Name </label>
						    <select class="form-control" name="category_id">
						    	<option value="">-Select One-</option>
						    	@foreach($categories as $category)
						    		<option value="{{ $category->id }}">{{ $category->category_name }}</option>
						    	@endforeach
						    </select>
					  	</div>
					  	<div class="form-group">
						    <label> Tag Name </label>
						    <select class="form-control" name="tag_id">
						    	<option value="">-Select One-</option>
						    	@foreach($tags as $tag)
						    		<option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
						    	@endforeach
						    </select>
					  	</div>
					  	<div class="form-group">
						    <label> Product Type Name </label>
						    <select class="form-control" name="product_type_id">
						    	<option value="">-Select One-</option>
						    	@foreach($product_types as $product_type)
						    		<option value="{{ $product_type->id }}">{{ $product_type->product_type_name }}</option>
						    	@endforeach
						    </select>
					  	</div>
					  	<div class="form-group">
						    <label> Product Name </label>
						    <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name">
						    @error('product_name')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Price </label>
						    <input type="text" class="form-control" name="product_price" placeholder="Enter Product Price">
						    @error('product_price')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Quantity </label>
						    <input type="text" class="form-control" name="product_quantity" placeholder="Enter Product Quantity">
						    @error('product_quantity')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Alert Quantity </label>
						    <input type="text" class="form-control" name="alert_quantity" placeholder="Enter Alert Quantity">
						    @error('alert_quantity')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Code </label>
						    <input type="text" class="form-control" name="product_code" placeholder="Enter Product Code">
						    @error('alert_quantity')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Short Description </label>
						    <textarea class="form-control" name="product_short_description" placeholder="Enter Product Short Description" rows="4"></textarea>
						    @error('product_short_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Long Description </label>
						    <textarea class="form-control" name="product_long_description" placeholder="Enter Product Long Description" rows="7"></textarea>
						    @error('product_long_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Thumbnail Photo </label>
						    <input type="file" class="form-control" name="product_thumbnail_photo">
						    {{-- @error('product_thumbnail_photo')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror --}}
					  	</div>
					  	<div class="form-group">
						    <label> Product Multiple Photo </label>
						    <input type="file" class="form-control" name="product_multiple_photo[]" multiple>
						    {{-- @error('product_multiple_photo')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror --}}
					  	</div>
				  		<button type="submit" class="btn btn-primary">Add New Product</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>
<!-- ########## END: MAIN PANEL ########## -->

@endsection
