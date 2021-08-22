@extends('layouts.dashbord_app')

@section('main_coupon')
  open
@endsection

@section('indexcoupon')
  active
@endsection

@section('title')
  Blog | Dashbord
@endsection

@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('coupon.index') }}">Coupon</a>
	    <span class="breadcrumb-item active">{{ $coupon_info->coupon_name }}</span>
  	</nav>

</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Coupon Edit Form</h4>
				<div class="card-body">

					<form method="post" action="{{ route('coupon.update',$coupon_info->id) }}" enctype="multipart/form-data">
					@csrf
                    @method('PATCH')

					  	<div class="form-group">
						    <label> Coupon Name </label>
						    <input type="text" class="form-control" name="coupon_name" value="{{ $coupon_info->coupon_name }}">
					  	</div>
					  	<div class="form-group">
						    <label> Coupon Discount </label>
						    <input type="text" class="form-control" name="coupon_discount" value="{{ $coupon_info->coupon_discount }}">
					  	</div>
					  	<div class="form-group">
						    <label> Coupon Description </label>
						    <textarea class="form-control" name="coupon_description">{{ $coupon_info->coupon_description }}</textarea>
					  	</div>
                          <div class="form-group">
						    <label> Minumum Purchase Amonut </label>
						    <input type="text" class="form-control" name="minimum_purchase_amount" value="{{ $coupon_info->minimum_purchase_amount }}">
					  	</div>
					  	<div class="form-group">
						    <label> Coupon Validity </label>
						    <input type="date" class="form-control" name="validity_till" value="{{ $coupon_info->validity_till }}">
					  	</div>
				  	    <button type="submit" class="btn btn-primary">Update Coupon</button>

					</form>

				</div>
		  	</div>
		</div>
	</div>
</div>
@endsection
@section('footer_scripts')

    <script>

        @if(session('success_coupon'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Coupon Update successfully.');
		@endif

    </script>

@endsection
