@extends('layouts.dashbord_app')

@section('main_coupon')
  open
@endsection

@section('addcoupon')
  active
@endsection

@section('title')
  Coupon | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('coupon.index') }}">Coupons</a>
	    <span class="breadcrumb-item active">Coupon Form</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Coupon Add Form</h4>
				<div class="card-body">
					@if(session('success_status'))
						<div class="alert alert-success">
							{{ session('success_status') }}
						</div>
					@endif
					<form method="post" action="{{ route('coupon.store') }}" enctype="multipart/form-data">
						@csrf
					  	<div class="form-group">
						    <label> Coupon Name </label>
						    <input type="text" class="form-control" name="coupon_name" placeholder="Enter Coupon Name">
						    @error('coupon_name')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Coupon Discount </label>
						    <input type="text" class="form-control" name="coupon_discount" placeholder="Enter Coupon Discount">
						    @error('coupon_discount')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Coupon Description </label>
						    <textarea class="form-control" name="coupon_description" placeholder="Enter Coupon Description"></textarea>
						    @error('coupon_description')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
                          <div class="form-group">
						    <label> Minumum Purchase Amonut </label>
						    <input type="text" class="form-control" name="minimum_purchase_amount"  placeholder="Enter Minimum Purchase Amount">
						    @error('minimum_purchase_amount')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label> Coupon Validity </label>
						    <input type="date" class="form-control" name="validity_till" placeholder="Enter Coupon Validity Till">
						    @error('validity_till')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
				  	<button type="submit" class="btn btn-primary">Add New Coupon</button>
					</form>
				</div>
		  	</div>
		</div>
	</div>
</div>

@endsection
