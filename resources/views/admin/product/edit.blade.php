@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('product')
  open
@endsection

@section('indexproduct')
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
	    <span class="breadcrumb-item active">{{ $product_info->product_name }}</span>
  	</nav>

</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Product Edit Form</h4>
				<div class="card-body">
					@if(session('success_status'))
						<div class="alert alert-success">
							{{ session('success_status') }}
						</div>
					@endif
					<form method="post" action="{{ route('product.update',$product_info->id) }}" enctype="multipart/form-data">
						@csrf
						@method('PATCH')
					  	<div class="form-group">
						    <label> Category Name </label>
						    <select class="form-control" name="category_id">
						    	<option value="">-Select One-</option>
						    	@foreach($categories as $category)
						    		<option {{ ($category->id == $product_info->category_id) ? "selected":"" }} value="{{ $category->id }}">{{ $category->category_name }}</option>
						    	@endforeach
						    </select>
					  	</div>
					  	<div class="form-group">
						    <label> Tag Name </label>
						    <select class="form-control" name="tag_id">
						    	<option value="">-Select One-</option>
						    	@foreach($tags as $tag)
						    		<option {{ ($tag->id == $product_info->tag_id) ? "selected":"" }} value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
						    	@endforeach
						    </select>
					  	</div>
					  	<div class="form-group">
						    <label> Product Name </label>
						    <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{ $product_info->product_name }}">
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Price </label>
						    <input type="text" class="form-control" name="product_price" placeholder="Enter Product Price"value="{{ $product_info->product_price }}">
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Quantity </label>
						    <input type="text" class="form-control" name="product_quantity" placeholder="Enter Product Quantity"value="{{ $product_info->product_quantity }}">
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Alert Quantity </label>
						    <input type="text" class="form-control" name="alert_quantity" placeholder="Enter Alert Quantity"value="{{ $product_info->alert_quantity }}">
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Short Description </label>
						    <textarea class="form-control" name="product_short_description" placeholder="Enter Product Short Description" rows="4">{{ $product_info->product_short_description }}</textarea>
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Long Description </label>
						    <textarea class="form-control" name="product_long_description" placeholder="Enter Product Long Description" rows="7">{{ $product_info->product_long_description }}</textarea>
						    @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Product Thumbnail Photo </label>
						    <input type="file" class="form-control" name="product_thumbnail_photo">
						    <img src="{{ asset('dashbord/image/product_image') }}/{{ $product_info->product_thumbnail_photo }}" class="img-fluid" alt="Category Photo">
						    {{-- @error('category_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror --}}
					  	</div>
				  	<button type="submit" class="btn btn-primary">Update Product</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>
<!-- ########## END: MAIN PANEL ########## -->

@endsection
