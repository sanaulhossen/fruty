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
  About | Dashbord
@endsection

@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item">About</span>
	   	<a class="breadcrumb-item active" href="{{ route('about.add') }}">Add About</a>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">About List</h4>
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="product_table">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($abouts as $about)
                                    <tr id="aboutLoop{{ $about->id }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ Str::limit($about->question, $limit = 15, $end = '....') }}</td>
                                        <td>{!! Str::limit($about->answer, $limit = 15, $end = '....') !!}</td>
                                        <td>{{ $about->relation_with_user->name }}</td>
                                        <td>
                                            {{ $about->created_at->format('d M Y') }}
                                        </td>
                                        <td>
                                            {{ $about->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('about.edit', $about->id) }}" type="button" class="btn btn-tone btn-success" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <input type="hidden" name="id" id="id" value="{{ $about->id }}">
                                                <a href="" type="button" class="add-to-delete-btn btn btn-tone btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>

                                            @if ( $about->status == 1 )
                                                @if ( active_about_count() < 3 )
                                                    <a href="{{ route('about.active', $about->id) }}" type="button" class="btn btn-tone btn-info" data-toggle="tooltip" data-placement="top" title="Active">
                                                        <i class="anticon anticon-check-circle"></i>
                                                    </a>
                                                @endif
                                            @elseif ( $about->status == 2 )
                                                <a href="{{ route('about.deactive', $about->id) }}" type="button" class="btn btn-tone btn-warning" data-toggle="tooltip" data-placement="top" title="Deactive">
                                                    <i class="anticon anticon-close-circle"></i>
                                                </a>
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


@endsection
@section('footer_scripts')
	<script>
        $('.add-to-delete-btn').click(function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var id = $(this).closest('.btn-group').find('#id').val();

            //alert(id);

            $.ajax({
                url: "/about/delete",
                method: "POST",
                data: {
                    'id': id,
                },
                success: function (response) {
                    $("#aboutLoop"+id).remove();
                    alertify.set('notifier','position','top-right');
                    alertify.success(response.status);
                },
            });
        });

        @if(session('demo_admin'))
            //Notify
            alertify.set('notifier','position','top-right');
            alertify.success('Sorry! You can not do this action.');
        @endif
    </script>
@endsection
