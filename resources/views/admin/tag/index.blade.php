@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('tag')
  open
@endsection

@section('indextag')
  active
@endsection

@section('title')
  Tag | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active">Tag</span>
	    <a class="breadcrumb-item" href="{{ url('add/tag') }}">Add Tag</a>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Tag List </h4>
				@if(session('delete_status'))
				<div class="alert alert-danger">
					{{ session('delete_status') }}
				</div>
				@endif
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="category_table">
                            <thead>
                                <tr>
                                    <th>Serial No.</th>
                                    <th>Tag Name</th>
                                    <th>Tag Description</th>
                                    <th>Tag Create By</th>
                                    <th>Create at</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($tags as $tag)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $tag->tag_name }}</td>
                                        <td>{{ $tag->tag_description }}</td>
                                        <td>{{ $tag->relation_with_user->name }}</td>
                                        <td>
                                            Date: {{ $tag->created_at->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            Created at {{ $tag->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('tag.edit', $tag->id) }}" type="button" class="btn btn-tone"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('tag.destroy', $tag->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
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
      $(function(){
        'use strict';

        $('#category_table').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });
      });

    @if(session('demo_admin'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Sorry! You can not do this action.');
    @endif
    </script>
@endsection

