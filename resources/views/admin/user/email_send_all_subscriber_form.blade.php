@extends('layouts.dashbord_app')

@section('title')
  Email Send All Subscriber | Dashbord
@endsection

@section('dashbord_content')
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('subscriber') }}">Subscriber</a>
	    <span class="breadcrumb-item">Email send to all subscriber</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<h4 class="mt-3 text-center">Email body</h4>
				<div class="card-body">

					<form method="post" action="{{ route('emailsend.allsubscriber') }}">
					@csrf

                        <div class="form-group">
						    <label> Subject </label>
						    <input type="text" class="form-control" name="subject">
					  	</div>
					  	<div class="form-group">
						    <label> Email </label>
						    <textarea class="form-control" id="email_body" name="email_body" rows="5"></textarea>
					  	</div>
				  	    <button type="submit" class="btn btn-primary">Send</button>

					</form>

				</div>
		  	</div>
		</div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Subscribers List</h5>
                    <ul class="list-group">

                        @foreach ($subscribers as $subscriber)
                            <li class="ml-3">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="text-dark">
                                            <small>{{ $subscriber->subscriber_email }}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
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

        //EDITOR FOR Email Body
        ClassicEditor
            .create( document.querySelector( '#email_body' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );

    </script>
@endsection
