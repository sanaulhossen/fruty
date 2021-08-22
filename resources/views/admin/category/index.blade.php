@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('category')
  open
@endsection

@section('indexcategory')
  active
@endsection

@section('title')
  Category | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active">Category</span>
	    <a class="breadcrumb-item" href="{{ url('add/category') }}">Add Category</a>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Category List</h4>
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
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Create By</th>
                                    <th>Photo</th>
                                    <th>Create At</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->category_description }}</td>
                                        <td>{{ $category->catrelationwithuser->name }}</td>
                                        <td>
                                            <div class="avatar avatar-image" style="min-width: 40px">
                                                <img src="{{ asset('dashbord/image/category_image') }}/{{ $category->category_photo }}" alt="{{ $category->category_photo }}">
                                            </div>
                                        </td>
                                        <td>
                                            Date: {{ $category->created_at->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            Create at {{ $category->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('category.edit', $category->id) }}" type="button" class="btn btn-tone"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('category.destroy', $category->id) }}" method="post">
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


    @if(session('demo_admin'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Sorry! You can not do this action.');
    @endif


    </script>
@endsection
