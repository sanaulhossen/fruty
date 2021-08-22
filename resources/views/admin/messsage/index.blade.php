@extends('layouts.dashbord_app')

@section('message')
  open
@endsection

@section('title')
  Message | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Message List</h4>

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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Created At</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                    <th>Reply</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contact_messages as $contact_message)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $contact_message->contact_name }}</td>
                                        <td>{{ $contact_message->contact_email }}</td>
                                        <td>{{ $contact_message->contact_message }}</td>
                                        <td>{{ $contact_message->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $contact_message->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('message.delete', $contact_message->id) }}" type="button" class="btn btn-danger btn-tone">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('message.send', $contact_message->id) }}" class="btn btn-info btn-tone">
                                                <i class="anticon anticon-mail"></i>
                                            </a>
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

    @if(session('reply_message'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Your reply send successfully.');
    @endif
    @if(session('demo_admin'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Sorry! You can not do this action.');
    @endif
    @if(session('forcedelete_status'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Message data deleted!');
    @endif

    </script>
@endsection
