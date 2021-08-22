@extends('layouts.dashbord_app')

@section('dashbord_content')

@section('title')
  Order Status | Dashbord
@endsection

@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active"> Order ID No. - {{ $active_order->id }}</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-8 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Order Status Edit Form</h4>
				<div class="card-body">

					<form method="post" action="{{ route('delivery.post') }}">
						@csrf

					  	<div class="form-group">
						    <label> Order ID </label>
                            <input type="text" class="form-control" name="id" value="{{ $active_order->id }}" readonly>
					  	</div>

					  	<div class="form-group">
						    <label> Delivery </label>
						    <select class="form-control" name="delivery_status">
						    	<option {{ ($active_order->delivery_status == 1) ? "selected":"" }} value="1">Pending</option>
                                <option {{ ($active_order->delivery_status == 2) ? "selected":"" }} value="2">Cancel</option>
                                <option {{ ($active_order->delivery_status == 3) ? "selected":"" }} value="3">Picked</option>
                                <option {{ ($active_order->delivery_status == 4) ? "selected":"" }} value="4">Shipping</option>
                                <option {{ ($active_order->delivery_status == 5) ? "selected":"" }} value="5">Delivered</option>
						    </select>
					  	</div>
				  		<button type="submit" class="btn btn-primary">Update Order</button>
					</form>

				</div>
		  	</div>
		</div>
	</div>
</div>
<!-- ########## END: MAIN PANEL ########## -->
@endsection
@section('footer_scripts')
    <script>

        @if(session('order_delivery'))
            alertify.set('notifier','position','top-right');
            alertify.success('Delivery Status Updated Successfully!');
        @endif

    </script>
@endsection
