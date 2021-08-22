@extends('layouts.dashbord_app')

@section('message')
  open
@endsection

@section('title')
  Message Send | Dashbord
@endsection

@section('dashbord_content')
<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Reply message</h4>
				<div class="card-body">

					<form method="post" action="{{ route('message.reply') }}">
					@csrf

					  	<div class="form-group">
						    <label> Email </label>
						    <input type="text" class="form-control" name="contact_email" value="{{ $messages->contact_email }}">
                            <input type="hidden" class="form-control" name="id" value="{{ $messages->id }}">
					  	</div>
                          <div class="form-group">
						    <label> Message </label>
                            <textarea class="form-control" name="contact_message" rows="5">{{ $messages->contact_message }}</textarea>
					  	</div>
					  	<div class="form-group">
						    <label> Reply </label>
						    <textarea class="form-control" name="reply" rows="5">{{ old('reply') }}</textarea>
					  	</div>
				  	    <button type="submit" class="btn btn-primary">Send</button>

					</form>

				</div>
		  	</div>
		</div>
	</div>
</div>
@endsection
