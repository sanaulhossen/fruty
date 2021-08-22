@extends('layouts.dashbord_app')

@section('instagramindex')
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
	    <a class="breadcrumb-item" href="{{ route('instagram.index') }}">Instagram</a>
	    <span class="breadcrumb-item active">{{ $insta_info->instagram_tag }}</span>
  	</nav>

</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Instagram Edit Form</h4>
				<div class="card-body">

					<form method="post" action="{{ route('instagram.update',$insta_info->id) }}" enctype="multipart/form-data">
					@csrf
                    @method('PATCH')

					  	<div class="form-group">
						    <label> Instagram Tag </label>
						    <input type="text" class="form-control" name="instagram_tag" value="{{ $insta_info->instagram_tag }}">
                            <input type="hidden" class="form-control" name="id" value="{{ $insta_info->id }}">
					  	</div>

					  	<div class="form-group">
						    <label> Instagram Photo </label>
						    <input type="file" class="form-control" name="instagram_img">
						    <img src="{{ asset('dashbord/image/instagram_image') }}/{{ $insta_info->instagram_img }}" class="img-fluid" alt="{{ $insta_info->instagram_img }}">
					  	</div>
				  	    <button type="submit" class="btn btn-primary">Update Instagram</button>

					</form>

				</div>
		  	</div>
		</div>
	</div>
</div>
@endsection
@section('footer_scripts')

    <script>

        @if(session('Blog_status'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Instagram Post Update Successfully.');
		@endif

    </script>

@endsection
