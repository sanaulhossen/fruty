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
	    <span class="breadcrumb-item active">Blog</span>
	   	<a class="breadcrumb-item" href="{{ route('add.blog') }}">Add Blog</a>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Blog Edit</h4>
				@if(session('delete_status'))
				<div class="alert alert-danger">
					{{ session('delete_status') }}
				</div>
				@endif
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="product_table">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Blog Image</th>
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($blogs as $blog)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $blog->relation_with_blog_category->title }}</td>
                                        <td>{{ Str::limit($blog->blog_title, $limit = 25, $end = '....') }}</td>
                                        <td>{!! Str::limit($blog->blog_description, $limit = 55, $end = '....')  !!}</td>
                                        <td>
                                            <div class="avatar avatar-image" style="min-width: 40px">
                                                <img src="{{ asset('dashbord/image/blog_image') }}/{{ $blog->blog_thumbnail_photo }}" alt="{{ $blog->blog_thumbnail_photo }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('blog.edit', $blog->id) }}" type="button" class="btn btn-tone">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <form action="{{ route('blog.destroy') }}" method="post">
                                                <input type="hidden" class="form-control" name="id" value="{{ $blog->id }}">
                                                @csrf
                                                    <button type="submit" class="btn btn-tone"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
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
	</div>
</div>


@endsection
@section('footer_scripts')
	<script>

    @if(session('Blog_status'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Blog Deleted successfully.');
    @endif
    @if(session('demo_admin'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Sorry! You can not do this action.');
    @endif

      $(function(){
        'use strict';

        $('#product_table').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });
      });
    </script>
@endsection
