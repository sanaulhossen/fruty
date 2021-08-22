@extends('layouts.dashbord_app')

@section('about_main')
  open
@endsection

@section('client')
  open
@endsection

@section('indexclient')
  active
@endsection

@section('title')
  Client | Dashbord
@endsection

@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active">Client</span>
	   	<a class="breadcrumb-item" href="{{ route('client.add') }}">Add Client</a>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Client</h4>

				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="product_table">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($clients as $client)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>
                                            <div class="avatar avatar-image" style="min-width: 40px">
                                                <img src="{{ asset('dashbord/image/client_image') }}/{{ $client->file }}" alt="{{ $client->file }}">
                                            </div>
                                        </td>
                                        <td>
                                            {{ $client->created_at->format('d M Y') }}
                                        </td>
                                        <td>
                                            Created at - {{ $client->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('blog.edit', $client->id) }}" type="button" class="btn btn-tone btn-info mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <form action="{{ route('blog.destroy') }}" method="post">
                                                <input type="hidden" class="form-control" name="id" value="{{ $client->id }}">
                                                @csrf
                                                    <button type="submit" class="btn btn-tone btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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

    </script>
@endsection
