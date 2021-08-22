@extends('layouts.dashbord_app')


@section('title')
  User Role | Dashbord
@endsection

@section('dashbord_content')
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('user') }}">User</a>
	    <span class="breadcrumb-item active"> User Name - {{ $user->name }}</span>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<h4 class="mt-3 text-center">Reply message</h4>
				<div class="card-body">

					<form method="post" action="{{ route('user.change', $user->id) }}">
					@csrf

					  	<div class="form-group">
						    <label> Name </label>
						    <input type="text" class="form-control" name="name" value="{{ $user->name }}" >
                            <input type="hidden" class="form-control" name="id" value="{{ $user->id }}" >
					  	</div>
					  	<div class="form-group">
						    <label> Role </label>
                            <select class="form-control" name="role">
						    	<option {{ ( $user->role == 1 ) ? "selected":"" }} value="1">Admin</option>
                                <option {{ ( $user->role == 2 ) ? "selected":"" }} value="2">User</option>
						    </select>
					  	</div>
				  		<button type="submit" class="btn btn-primary">Update Role</button>

					</form>

				</div>
		  	</div>
		</div>
	</div>
</div>
@endsection
@section('footer_scripts')
	<script>

    @if(session('success_status'))
        //Notify
        alertify.set('notifier','position','top-right');
        alertify.success('Role changed successfully.');
    @endif

    </script>
@endsection
