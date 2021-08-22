@extends('layouts.dashbord_app')

@section('main_slider')
  open
@endsection

@section('indexslider')
  active
@endsection

@section('title')
  Slider | Dashbord
@endsection

@section('dashbord_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item active">Slider</span>
	   	<a class="breadcrumb-item" href="{{ url('add/slider') }}">Add Slider</a>
  	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h4 class="mt-3 text-center">Slider List ( active )</h4>
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
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Description</th>
                                    <th>Create By</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sliders as $slider)
                                    <tr>
                                        <td>{{ $slider->slider_title }}</td>
                                        <td>{{ $slider->slider_sub_title }}</td>
                                        <td>{{ $slider->slider_description }}</td>
                                        <td>{{ $slider->SliderTorelationwithuser->name }}</td>
                                        <td>
                                            <div class="avatar avatar-image" style="min-width: 40px">
                                                <img src="{{ asset('dashbord/image/slider_image') }}/{{ $slider->slider_photo }}" alt="slider Photo {{ $slider->slider_photo }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('slider.edit', $slider->id) }}" type="button" class="btn btn-tone"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('slider.destroy', $slider->id) }}" method="post">
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
