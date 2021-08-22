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
	    <span class="breadcrumb-item active">Instagram</span>
	   	<a class="breadcrumb-item" href="{{ route('instagram.add') }}">Add Instagram</a>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Instagram Post</h4>
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
                                    <th>Serial</th>
                                    <th>Tag</th>
                                    <th>Create By</th>
                                    <th>Image</th>
                                    <th>Create at</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posts as $post)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>#{{ $post->instagram_tag }}</td>
                                        <td>{{ $post->relation_with_user->name }}</td>
                                        <td>
                                            <div class="avatar avatar-image" style="min-width: 40px">
                                                <img src="{{ asset('dashbord/image/instagram_image') }}/{{ $post->instagram_img }}" alt="slider Photo {{ $post->instagram_img }}">
                                            </div>
                                        </td>
                                        <td>
                                            Date: {{ $post->created_at->format('d M Y') }}
                                        </td>
                                        <td>
                                            Created at {{ $post->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('instagram.edit', $post->id) }}" type="button" class="btn btn-tone" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>
                                                <form action="{{ route('instagram.destroy', $post->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                    <input type="hidden" class="form-control" name="id" value="{{ $post->id }}">
                                                    <button type="submit" class="btn btn-tone" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            @if ( $post->status == 1 )
                                                <form method="POST" action="{{ route('instagram.active') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $post->id }}">

                                                    @if ( active_instagram_count() < 6 )
                                                        <button type="submit" class="btn btn-tone" data-toggle="tooltip" data-placement="top" title="Active"><i class="far fa-check-circle"></i></button>
                                                    @endif

                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('instagram.deactive') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $post->id }}">
                                                    <button type="submit" class="btn btn-tone" data-toggle="tooltip" data-placement="top" title="Deactive"><i class="far fa-stop-circle"></i></button>
                                                </form>

                                            @endif

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
<!-- ########## END: MAIN PANEL ########## -->
@endsection

@section('footer_scripts')

    <script>

        @if(session('Blog_status'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Instagram post deleted!!');
		@endif

        @if(session('faq_status'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Active Successfully!');
		@endif

        @if(session('faq_deactive'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Deactive Successfully!');
		@endif

        @if(session('demo_admin'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Sorry! You can not do this action.');
        @endif

    </script>

@endsection

