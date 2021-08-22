@extends('layouts.dashbord_app')

@section('main_coupon')
  open
@endsection

@section('indexcoupon')
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
        <span class="breadcrumb-item">Coupons</span>
        <a class="breadcrumb-item" href="{{ url('add/coupon') }}">Add New Coupon</a>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Coupon List</h4>
				@if(session('delete_status'))
				<div class="alert alert-danger">
					{{ session('delete_status') }}
				</div>
				@endif
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="category_table">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Coupon Name</th>
                                    <th>Coupon Discount</th>
                                    <th>Coupon Description</th>
                                    <th>Minimum Purchase Amount</th>
                                    <th>Validity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $coupon->coupon_name }}</td>
                                        <td>{{ $coupon->coupon_discount }}</td>
                                        <td>{{ $coupon->coupon_description }}</td>
                                        <td>{{ $coupon->minimum_purchase_amount }}</td>
                                        <td>{{ $coupon->validity_till }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('coupon.edit',$coupon->id) }}" type="button" class="btn btn-tone">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <form action="{{ url('coupon.destroy', $coupon->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                    <button type="submit" class="btn btn-tone"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="50" class="text-center text-danger">No Data Availabke</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer_scripts')
	<script>

    @if(session('demo_admin'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Sorry! You can not do this action.');
    @endif

    </script>
@endsection
