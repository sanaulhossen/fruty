@extends('layouts.dashbord_app')

@section('about_main')
  open
@endsection

@section('client')
  open
@endsection

@section('addclient')
  active
@endsection

@section('title')
  Add About | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-10 m-auto">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('client.index') }}">Client</a>
	    <span class="breadcrumb-item active">Add Client</span>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Client Add Form</h4>
				<div class="card-body">


					<form method="post" action="{{ route('client.store') }}" enctype="multipart/form-data">
					@csrf

					  	<div class="form-group">
						    <label> Client Name </label>
						    <input type="text" class="form-control" name="name" placeholder="Enter Client Name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
					  	</div>
					  	<div class="form-group">
						    <label> Client Image </label>
                            <input type="file" class="form-control" name="file">
                            @if ($errors->has('file'))
                                <span class="text-danger">{{ $errors->first('file') }}</span>
                            @endif
					  	</div>
				  		<button type="submit" class="btn btn-primary">Add New Client</button>

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

    @if(session('success_status'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Client Add successfully.');
    @endif

    </script>
@endsection
