@extends('layouts.dashbord_app')

@section('title')
  Subscriber | Dashbord
@endsection

@section('dashbord_content')
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active">Subscriber</span>
  	</nav>
</div>
{{-- SUBSCRIBER SECTION START --}}
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header">
                    <h4>Subscriber List
                        <a href="{{ route('email.allsubscriber') }}" class="btn btn-primary btn-tone float-right">
                            Send Email <i class="fas fa-paper-plane"></i>
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="sub_table">
                            <thead>
                                <tr>
                                    <th>SL. No.</th>
                                    <th>ID. No.</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Time</th>
                                    <th>Ago</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($subes as $sube)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $sube->id }}</td>
                                        <td>{{ $sube->subscriber_email  }}</td>
                                        <td>{{ $sube->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $sube->created_at->timezone('Asia/Dhaka')->format('h:i:s A') }}</td>
                                        <td>{{ $sube->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('subscriber.delete', $sube->id) }}" type="button" class="btn btn-danger btn-tone">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $subes->links() }}
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
{{-- SUBSCRIBER SECTION END --}}
@endsection
@section('footer_scripts')
	<script>

    @if(session('forcedelete_status'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Record deleted successfully.');
    @endif
    @if(session('demo_admin'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Sorry! You can not do this action.');
    @endif

    </script>
@endsection
