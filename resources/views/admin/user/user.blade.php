@extends('layouts.dashbord_app')

@section('title')
  User | Dashbord
@endsection

@section('dashbord_content')
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active">User</span>
  	</nav>
</div>
{{-- ADMIN USER SECTION START --}}
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header">
                    <h4>Admin & User List
                        <a href="{{ route('email.alluser') }}" class="btn btn-primary btn-tone float-right">
                            Send Email <i class="fas fa-paper-plane"></i>
                        </a>
                    </h4>
                </div>

				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="admin_table">
                            <thead>
                                <tr>
                                    <th>SL. No.</th>
                                    <th>ID. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Time</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                    <th>Mail</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $user->created_at->timezone('Asia/Dhaka')->format('h:i:s A') }}</td>
                                        <td>
                                            @if ( $user->role == 1 )
                                                <a class="btn btn-danger btn-tone" data-toggle="tooltip" data-placement="top" title="Admin">
                                                    Admin
                                                </a>
                                            @elseif ( $user->role == 2 )
                                                <a class="btn btn-success btn-tone" data-toggle="tooltip" data-placement="top" title="User">
                                                    User
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('role.change', $user->id) }}" class="btn btn-info btn-tone" data-toggle="tooltip" data-placement="top" title="change role">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.message', $user->id) }}" class="btn btn-secondary btn-tone">
                                                <i class="anticon anticon-mail"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- ADMIN USER SECTION START --}}
@endsection
@section('footer_scripts')
	<script>

    @if(session('email_all_user'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Mail Send successfully!');
    @endif

    @if(session('demo_admin'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Sorry! You can not edit.');
    @endif

    </script>
@endsection
