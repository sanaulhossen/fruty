@extends('layouts.dashbord_app')

@section('main_blog')
  open
@endsection

@section('blog')
  open
@endsection

@section('addblog')
  active
@endsection

@section('title')
  Blog | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <a class="breadcrumb-item" href="{{ route('blog.index') }}">Blog</a>
	    <span class="breadcrumb-item active">Add Blog</span>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Blog Add Form</h4>
				<div class="card-body">

					<form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
					@csrf

					  	<div class="form-group">
						    <label> Blog Category </label>
						    <select class="form-control" name="blogCategory_id">
						    	<option value="">-Select One-</option>
						    	@foreach($Blog_cates as $Blog_caty)
						    		<option value="{{ $Blog_caty->id }}">{{ $Blog_caty->title }}</option>
						    	@endforeach
						    </select>
					  	</div>
					  	<div class="form-group">
						    <label> Blog title </label>
						    <input type="text" class="form-control" name="blog_title" placeholder="Enter Blog Title">
					  	</div>
					  	<div class="form-group">
						    <label> Blog Description </label>
						    <textarea class="form-control" id="blog_description" name="blog_description" placeholder="Enter Blog Description" rows="4"></textarea>
					  	</div>
					  	<div class="form-group">
						    <label> Blog Thumbnail Photo </label>
						    <input type="file" class="form-control" name="blog_thumbnail_photo">
					  	</div>
				  		<button type="submit" class="btn btn-primary">Add New Blog</button>

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

        @if(session('Blog_status'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Blog Add successfully.');
		@endif

        //EDITOR FOR TESTAREA
        ClassicEditor
            .create( document.querySelector( '#blog_description' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
