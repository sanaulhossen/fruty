@extends('layouts.dashbord_app')

@section('main_blog')
  open
@endsection

@section('blog')
  open
@endsection

@section('indexblog')
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
	    <span class="breadcrumb-item active">{{ $blog_info->blog_title }}</span>
  	</nav>

</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Product Edit Form</h4>
				<div class="card-body">

					<form method="post" action="{{ route('blog.update',$blog_info->id) }}" enctype="multipart/form-data">
					@csrf
                    @method('PATCH')

					  	<div class="form-group">
						    <label> Blog Category Name </label>
						    <select class="form-control" name="blogCategory_id">
						    	<option value="">-Select One-</option>
						    	@foreach($Blog_cates as $Blog_caty)
						    		<option {{ ($Blog_caty->id == $blog_info->blogCategory_id) ? "selected":"" }} value="{{ $Blog_caty->id }}">
                                        {{ $Blog_caty->title }}
                                    </option>
						    	@endforeach
						    </select>
					  	</div>
					  	<div class="form-group">
						    <label> Blog Title </label>
						    <input type="text" class="form-control" name="blog_title" value="{{ $blog_info->blog_title }}">
                            <input type="hidden" class="form-control" name="id" value="{{ $blog_info->id }}">
					  	</div>
					  	<div class="form-group">
						    <label> Blog Description </label>
						    <textarea class="form-control" id="blog_description" name="blog_description" rows="7">{{ $blog_info->blog_description }}</textarea>
					  	</div>
					  	<div class="form-group">
						    <label> Product Thumbnail Photo </label>
						    <input type="file" class="form-control" name="blog_thumbnail_photo">
						    <img src="{{ asset('dashbord/image/blog_image') }}/{{ $blog_info->blog_thumbnail_photo }}" class="img-fluid" alt="Category Photo">
					  	</div>
				  	    <button type="submit" class="btn btn-primary">Update Blog</button>

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
            alertify.success('Blog Update successfully.');
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
