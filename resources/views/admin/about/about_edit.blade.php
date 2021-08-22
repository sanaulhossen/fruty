@extends('layouts.dashbord_app')

@section('about_main')
  open
@endsection

@section('about')
  open
@endsection

@section('indexabout')
  active
@endsection

@section('title')
  About Edit | Dashbord
@endsection

@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-10 m-auto">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('about.index') }}">About</a>
	    <span class="breadcrumb-item active">{{ $about_info->question }}</span>
  	</nav>

</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">About Edit Form</h4>
				<div class="card-body">

					<form id="about_edit_form">
					@csrf

					  	<div class="form-group">
						    <label> About Question </label>
                            <input type="hidden" id="id" name="id" value="{{ $about_info->id }}">
						    <input type="text" class="form-control" id="question" name="question" value="{{ $about_info->question }}" placeholder="Enter About Question">
					  	</div>
					  	<div class="form-group">
						    <label> About Answer </label>
						    <textarea class="form-control" id="answer" name="answer" placeholder="Enter About Answer" rows="4">{{ $about_info->answer }}</textarea>
					  	</div>
				  	    <button type="submit" class="btn btn-primary">Update About</button>

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
        $("#about_edit_form").submit(function(e){
            e.preventDefault();

            let id = $("#id").val();
            let question = $("#question").val();
            let answer = $("#answer").val();
            let _token = $("input[name=_token]").val();

            //alert(_token);

            $.ajax({
                url:"{{ route('about.update') }}",
                type:"POST",
                data:{
                    id:id,
                    question:question,
                    answer:answer,
                    _token:_token
                },
                success:function(response){
                    alertify.set('notifier','position','top-right');
                    alertify.success(response.status);
                }
            });
        });
    </script>
    <script>

        @if(session('Blog_status'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Blog Update successfully.');
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
