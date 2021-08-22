@extends('layouts.dashbord_app')

@section('main_blog')
  open
@endsection

@section('blog_category')
  active
@endsection

@section('title')
  Blog Category | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active">Blog Category</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-7">

            @if(session('delete_status'))
                <div class="alert alert-danger">
                    {{ session('delete_status') }}
                </div>
            @endif

			<div class="card">
				<h4 class="mt-3 text-center">Blog Category List</h4>
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="blogCategory_table">
                            <thead>
                                <tr>
                                    <th>ID.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($BlogCategories as $BlogCategory)
                                    <tr id="blogCategoryLoopID{{ $BlogCategory->id }}">
                                        <td>{{ $BlogCategory->id }}</td>
                                        <td>{{ $BlogCategory->title }}</td>
                                        <td>{!! $BlogCategory->description !!}</td>
                                        <td>
                                            <a href='javascript:void(0)' onclick='edit({{ $BlogCategory->id }})' class='btn btn-tone'>
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('blogCategory.destroy', $BlogCategory->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-tone"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="50" class="text-center text-danger">No Data Availabke</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
        <div class="col-md-5">
            <div class="card">
				<h4 class="mt-3 text-center">Blog Category Add Form</h4>
				<div class="card-body">

					@if(session('success_status'))
						<div class="alert alert-success">
							{{ session('success_status') }}
						</div>
					@endif

					<form id="blogCategory_create_form">
                    @csrf

					  	<div class="form-group">
						    <label>Blog Category Name </label>
						    <input type="text" class="form-control" name="title" id="title"  placeholder="Enter Title">
                            @error('title')
						    	<span class="text-danger">{{ $message }}</span>
						    @enderror
					  	</div>
					  	<div class="form-group">
						    <label>Blog Category Description </label>
						    <textarea class="form-control" rows="5" id="description"  placeholder="Enter Description"></textarea>

					  	</div>
				  	    <button type="submit" class="btn btn-primary">Add New Category</button>

					</form>

				</div>
		  	</div>
        </div>
	</div>

    <div id="modaldemo2" class="modal fade">
        <div class="modal-dialog modal-dialog-vertical-center">

            <form id="blogCategory_edit_form">
            @csrf
            <input type="hidden" id="id" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">{{ __('Edit Blog Category') }}</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        {{-- FORM FIELD --}}
                        <div class="form-group">
                            <label> Title </label>
                            <input type="text" class="form-control" id="title1"  placeholder="Enter Title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label> Description </label>
                            <textarea class="form-control" rows="5" id="description1"  placeholder="Enter Description">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">{{ __('Submit') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    </div>
                </div>
            </form>

        </div><!-- modal-dialog -->
    </div><!-- modal -->

</div>

@endsection
@section('footer_scripts')

    {{-- EDITOR FOR TESTAREA --}}
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <script>
        $("#blogCategory_create_form").submit(function(e){
            e.preventDefault();

            let title = $("#title").val();
            let description = $("#description").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url:"{{ route('blogCategory.store') }}",
                type:"POST",
                data:{
                    title:title,
                    description:description,
                    _token:_token
                },
                success:function(response){
                    if (response) {
                        $("#blogCategory_table tbody").prepend('<tr><td>'+ response.id +'</td><td>'+ response.title +'</td><td>' + response.description + '</td><td>' + "<a href='javascript:void(0)' onclick='edit()' class='btn btn-info'>Edit</a>" + '</td><td>' + "<button type='submit' class='btn btn-danger'><i class='fas fa-trash'></i></button>" + '</td></tr>');
                        $("#blogCategory_create_form")[0].reset();
                        alertify.set('notifier','position','top-right');
                        alertify.success('Blog Category add successfully.');
                    }
                }
            });
        });
    </script>
    <script>
        function edit(id){
            $.get('blogCategory/edit/'+id,function(blogCategory){
                $("#id").val(blogCategory.id);
                $("#title1").val(blogCategory.title);
                $("#description1").val(blogCategory.description);
                $("#modaldemo2").modal('toggle');
            });
        }
        $("#blogCategory_edit_form").submit(function(e){
            e.preventDefault();

            let id = $("#id").val();
            let title = $("#title1").val();
            let description = $("#description1").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url:'/blogCategory/update/model',
                type:"PUT",
                data:{
                    id:id,
                    title:title,
                    description:description,
                    _token:_token
                },
                success:function(response){

                    $('#blogCategoryLoopID' + response.id +' td:nth-child(1)').text(response.id);
                    $('#blogCategoryLoopID' + response.id +' td:nth-child(2)').text(response.title);
                    $('#blogCategoryLoopID' + response.id +' td:nth-child(3)').text(response.description);
                    $("#modaldemo2").modal('toggle');
                    $("#blogCategory_edit_form")[0].reset();
                    alertify.set('notifier','position','top-right');
                    alertify.success('Blog Category Updated Successfully.');
                }
            })
        });
    </script>
@endsection
