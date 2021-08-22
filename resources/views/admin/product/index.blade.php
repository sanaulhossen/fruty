@extends('layouts.dashbord_app')

@section('product_main')
  open
@endsection

@section('product')
  open
@endsection

@section('indexproduct')
  active
@endsection
@section('title')
  Product | Dashbord
@endsection

@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active">Product</span>
	   	<a class="breadcrumb-item" href="{{ url('add/product') }}">Add Product</a>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Product Edit</h4>
				@if(session('delete_status'))
				<div class="alert alert-danger">
					{{ session('delete_status') }}
				</div>
				@endif
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="product_table">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Category</th>
                                    <th>Tag</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Alert</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                    <th>Deal</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($products as $product)
                                    <tr class="{{ ($product->product_quantity <= $product->alert_quantity) ? 'bg-warning':'' }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $product->relationwithcategory->category_name }}</td>
                                        <td>{{ $product->relationwithTag->tag_name }}</td>
                                        <td>{{ $product->relationwithtype->product_type_name }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_price }}</td>
                                        <td>{{ $product->product_quantity }}</td>
                                        <td>{{ $product->alert_quantity }}</td>
                                        <td>
                                            <div class="avatar avatar-image" style="min-width: 40px">
                                                <img src="{{ asset('dashbord/image/product_image') }}/{{ $product->product_thumbnail_photo }}" alt="{{ $product->product_thumbnail_photo }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('product.edit', $product->id) }}" type="button" class="btn btn-tone btn-info">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                    <button type="submit" class="btn btn-tone btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            @if ( $product->dealsOfDay )
                                                <a href="{{ route('product.deal', $product->id) }}" type="button" class="btn btn-info">Unset</a>
                                            @else
                                                <a href="{{ route('product.deal', $product->id) }}" type="button" class="btn btn-info">Set</a>
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
      $(function(){
        'use strict';

        $('#product_table').DataTable({
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
