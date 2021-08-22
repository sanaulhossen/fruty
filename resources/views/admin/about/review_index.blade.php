@extends('layouts.dashbord_app')

@section('about_main')
  open
@endsection

@section('review')
  active
@endsection

@section('title')
  Team | Dashbord
@endsection


@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item">Review</span>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6">
            <div class="card">

                <form action="{{ route('review.store1') }}" method="post">
                @csrf

                    <div class="card-body">
                        <h4>Our Clients</h4>
                        <input class="form-control" type="number" name="our_clients" value="{{ $review->our_clients }}" placeholder="Enter Total Client">
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>

            </div>
		</div>
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('review.store2') }}" method="post">
                @csrf

                    <div class="card-body">
                        <h4>Total Categories</h4>
                        <input class="form-control" type="number" name="total_categories" value="{{ $review->total_categories }}" placeholder="Enter Total Categories">
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>

            </div>
		</div>
        <div class="col-md-6">
            <div class="card">

                <form action="{{ route('review.store3') }}" method="post">
                @csrf

                    <div class="card-body">
                        <h4>In Country</h4>
                        <input class="form-control" type="number" name="in_country" value="{{ $review->in_country }}" placeholder="Enter In Country Service">
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>

            </div>
		</div>
        <div class="col-md-6">
            <div class="card">

                <form action="{{ route('review.store4') }}" method="post">
                @csrf

                    <div class="card-body">
                        <h4>Happy Customer</h4>
                        <input class="form-control" type="number" name="happy_customer" value="{{ $review->happy_customer }}" placeholder="Enter Happy Customer">
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>

            </div>
		</div>
	</div>
</div>


@endsection
@section('footer_scripts')
	<script>

        @if(session('review_status'))
            alertify.set('notifier','position','top-right');
            alertify.success('Review Added Successfully.');
		@endif

    </script>
@endsection
