@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('type')
  open
@endsection

@section('indextype')
  active
@endsection

@section('title')
  Product Type | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active">Product Type</span>
	    <a class="breadcrumb-item" href="{{ url('add/product_type') }}">Add Product Type</a>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Product Type List ( active )</h4>
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
                                    <th>Type Name</th>
                                    <th>Type Description</th>
                                    <th>Create By</th>
                                    <th>Create At</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($product_types as $product_type)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $product_type->product_type_name }}</td>
                                        <td>{{ $product_type->product_type_description }}</td>
                                        <td>{{ $product_type->relationwithuser->name }}</td>
                                        <td>
                                            <li>Date: {{ $product_type->created_at->format('d/m/Y') }}</li>
                                        </td>
                                        <td>
                                            <li>{{ $product_type->created_at->diffForHumans() }}</li>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('productType.edit', $product_type->id) }}" type="button" class="btn btn-tone"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('productType.destroy', $product_type->id) }}" method="post">
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
