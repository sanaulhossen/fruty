@extends('layouts.dashbord_app')

@section('title')
  All Admin | Dashbord
@endsection

@section('dashbord_content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-10">
            <div class="card p-3">
                <div class="card-body p-4">
                    <div class="media align-items-center">
                        <div class="avatar avatar-cyan avatar-icon avatar-square">
                            <i class="anticon anticon-star"></i>
                        </div>
                        <div class="m-l-15">
                            <h6 class="mb-0">All Admin ({{ total_admin() }})</h6>
                            <span class="text-gray font-size-13">F r u t y</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="card p-3">
                <div class="card-body p-4 mt-1">
                    <div class="media align-items-center float-right">
                        <button id="list-view-btn" type="button" class="btn btn-default btn-icon">
                            <i class="anticon anticon-ordered-list"></i>
                        </button>
                        <button id="card-view-btn" type="button" class="btn btn-default btn-icon active ml-1">
                            <i class="anticon anticon-appstore"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <!-- Card View -->
            <div class="row" id="card-view">

                @foreach ($admins as $admin)

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="m-t-20 text-center">
                                    <div class="avatar avatar-image" style="height: 100px; width: 100px;">
                                        <img src="{{ asset('dashbord') }}/image/profile_photo/{{ $admin->profile_photo }}" alt="{{ $admin->profile_photo }}">
                                    </div>
                                    <h4 class="m-t-30">{{ $admin->name }}</h4>
                                    <p>{{ $admin->email }}</p>
                                </div>
                                <div class="text-center m-t-15">
                                    <button class="m-r-5 btn btn-icon btn-hover btn-rounded">
                                        <i class="anticon anticon-facebook"></i>
                                    </button>
                                    <button class="m-r-5 btn btn-icon btn-hover btn-rounded">
                                        <i class="anticon anticon-twitter"></i>
                                    </button>
                                    <button class="m-r-5 btn btn-icon btn-hover btn-rounded">
                                        <i class="anticon anticon-instagram"></i>
                                    </button>
                                </div>
                                <div class="text-center m-t-30">
                                    <a href="profile.html" class="btn btn-primary btn-tone">
                                        <i class="anticon anticon-mail"></i>
                                        <span class="m-l-5">Contact</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach


            </div>
            <div class="row d-none" id="list-view">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Social</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <td>
                                                        <div class="media align-items-center">
                                                            <div class="avatar avatar-image">
                                                                <img src="{{ asset('dashbord') }}/image/profile_photo/{{ $admin->profile_photo }}" alt="{{ $admin->profile_photo }}">
                                                            </div>
                                                            <div class="media-body m-l-15">
                                                                <h6 class="mb-0">{{ $admin->name }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>
                                                        <button class="m-r-5 btn btn-icon btn-hover btn-rounded">
                                                            <i class="anticon anticon-facebook"></i>
                                                        </button>
                                                        <button class="m-r-5 btn btn-icon btn-hover btn-rounded">
                                                            <i class="anticon anticon-twitter"></i>
                                                        </button>
                                                        <button class="m-r-5 btn btn-icon btn-hover btn-rounded">
                                                            <i class="anticon anticon-instagram"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="profile.html" class="btn btn-primary btn-tone">
                                                            <i class="anticon anticon-mail"></i>
                                                            <span class="m-l-5">Contact</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
