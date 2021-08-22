@extends('layouts.dashbord_app')

@section('message')
  open
@endsection

@section('title')
  Email Send | Dashbord
@endsection

@section('dashbord_content')
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('user') }}">User</a>
	    <span class="breadcrumb-item">Email send</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Send an email to <strong>{{ $user->name }}</strong></h4>
				<div class="card-body">

					<form method="post" action="{{ route('email.send') }}">
					@csrf

					  	<div class="form-group">
						    <label> Nane </label>
						    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">
					  	</div>
                        <div class="form-group">
						    <label> Email </label>
						    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
					  	</div>
                        <div class="form-group">
						    <label> Subject </label>
						    <input type="text" class="form-control" name="subject">
					  	</div>
					  	<div class="form-group">
						    <label> Email </label>
						    <textarea class="form-control" name="email_send" rows="5">{{ old('email_send') }}</textarea>
					  	</div>
				  	    <button type="submit" class="btn btn-primary">Send</button>

					</form>

				</div>
		  	</div>
		</div>
	</div>
</div>
@endsection
@section('footer_scripts')
	<script>

    @if(session('reply_email'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Your email send successfully.');
    @endif

    </script>
@endsection
