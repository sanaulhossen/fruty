@extends('layouts.dashbord_app')

@section('about_main')
  open
@endsection

@section('about')
  open
@endsection

@section('addabout')
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
	    <a class="breadcrumb-item" href="{{ route('about.index') }}">About</a>
	    <span class="breadcrumb-item active">Add About</span>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">About Add Form</h4>
				<div class="card-body">

					<form id="about_add_form">
					@csrf

					  	<div class="form-group">
						    <label> About Question </label>
						    <input type="text" class="form-control" id="question" name="question" placeholder="Enter About Question">
					  	</div>
					  	<div class="form-group">
						    <label> About Answer </label>
						    <textarea class="form-control" id="answer" name="answer" placeholder="Enter About Answer" rows="4"></textarea>
					  	</div>
				  		<button type="submit" class="btn btn-primary">Add New About</button>

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
        $("#about_add_form").submit(function(e){
            e.preventDefault();

            let question = $("#question").val();
            let answer = $("#answer").val();
            let _token = $("input[name=_token]").val();

            //alert(question);

            $.ajax({
                url:"{{ route('about.store') }}",
                type:"POST",
                data:{
                    question:question,
                    answer:answer,
                    _token:_token
                },
                success:function(response){
                    alertify.set('notifier','position','top-right');
                    alertify.success(response.status);
                    $("#about_add_form")[0].reset();
                }
            });
        });
    </script>
    <script>

        @if(session('Blog_status'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Blog Add successfully.');
		@endif

        //EDITOR FOR TESTAREA
        ClassicEditor
            .create( document.querySelector( '#answer' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
