@extends('layouts.dashbord_app')

@section('instagramadd')
  active
@endsection

@section('title')
  Instagram | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('instagram.index') }}">Instagram Post</a>
	    <span class="breadcrumb-item active">Add Instagram form</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Instagram Add Form</h4>
				<div class="card-body">

					<form method="post" action="{{ route('instagram.store') }}" enctype="multipart/form-data">
					@csrf

					  	<div class="form-group">
						    <label> Instagram Tag </label>
						    <input type="text" class="form-control" name="instagram_tag" placeholder="Enter Tag Name">
					  	</div>
					  	<div class="form-group">
						    <label> Instagram Picture </label>
						    <input type="file" class="form-control" name="instagram_img" >
					  	</div>
				  	    <button type="submit" class="btn btn-primary">Add New Instagram</button>

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
            alertify.success('Instagram post added successfully!');
		@endif

    </script>

@endsection
