@extends('layouts.dashbord_app')
@section('product')
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
				<h4 class="mt-3 text-center">Product Deal Edit Form</h4>
				<div class="card-body">
					@if(session('delete_status'))
						<div class="alert alert-success">
							{{ session('delete_status') }}
						</div>
					@endif
					<form method="post" action="{{ route('deal.update') }}">
					@csrf

					  	<div class="form-group">
						    <label> Product Name </label>
						    <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{ $product_info->product_name }}">
					  	</div>
					  	<div class="form-group">
						    <label> Deal Price </label>
						    <input type="text" class="form-control" name="dealsOfDay" placeholder="Enter Product Price"value="{{ $product_info->dealsOfDay }}">
					  	</div>
                          <div class="form-group">
						    <label> Product Price </label>
                            <input type="hidden" name="id" value="{{ $product_info->id }}">
						    <input type="text" class="form-control" name="product_price" placeholder="Enter Product Deal Price" value="{{ $product_info->product_price }}">
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
