@extends('layouts.dashbord_app')

@section('about_main')
  open
@endsection

@section('team')
  open
@endsection

@section('indexteam')
  active
@endsection

@section('title')
  Team | Dashbord
@endsection


@section('dashbord_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="col-md-12">
  	<nav class="breadcrumb sl-breadcrumb">
	    <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
	    <span class="breadcrumb-item">Team</span>
  	</nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header">
                    <h4>Team List
                        <a href="" class="btn btn-primary btn-tone float-right" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="anticon anticon-plus-circle"></i> Add Team
                        </a>
                    </h4>
                </div>
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="product_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Store Modal Start -->
<div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Team Add</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>

            <form id="addTeamForm" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <ul class="alert alert-warning d-none" id="save_error_list"></ul>
                    <div class="form-group">
                        <label> Name </label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label> Position </label>
                        <input type="text" class="form-control" name="position" placeholder="Enter Position">
                    </div>
                    <div class="form-group">
                        <label> Image </label>
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-tone" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-tone">
                        <i class="anticon anticon-plus-circle"></i> Add New Team
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- Store Modal Start -->

<!-- Edit Modal Start -->
<div class="modal fade" id="editModalCenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Team Update</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>

            <form id="updateTeamForm" method="post" enctype="multipart/form-data">

                <div class="modal-body">

                    <input type="hidden" name="emp_id" id="emp_id">
                    <ul class="alert alert-warning d-none" id="update_error_list"></ul>

                    <div class="form-group">
                        <label> Name </label>
                        <input type="text" class="form-control" name="name" id="edit_name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label> Position </label>
                        <input type="text" class="form-control" name="position" id="edit_position" placeholder="Enter Position">
                    </div>
                    <div class="form-group">
                        <label> Image </label>
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-tone" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-tone">
                        <i class="anticon anticon-plus-circle"></i> Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- Edit Modal Start -->

<!-- Delete Modal Start -->
<div class="modal fade" id="DeleteModalCenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Team Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>


                <div class="modal-body">


                    <h4>Do you want to delete data?</h4>
                    <input type="hidden" id="delete_team_id">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-tone" data-dismiss="modal">Close</button>
                    <button type="button" class="delete_model_btn btn btn-primary btn-tone">
                        <i class="anticon anticon-delete"></i> Yes! Delete.
                    </button>
                </div>

        </div>
    </div>
</div>
<!-- Delete Modal Start -->

@endsection
@section('footer_scripts')
	<script>

        $(document).ready(function(){

            //Ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            TeamData();


            //Team data call from here
            function TeamData(){
                $.ajax({
                    url: "/team-data",
                    method: "GET",
                    dataType: "json",
                    success: function (response){
                        // console.log(response.team);
                        $('tbody').html("");
                        $.each(response.team, function (key, item){
                            $('tbody').append('<tr>\
                                    <td>'+item.id+'</td>\
                                    <td>'+item.name+'</td>\
                                    <td>'+item.position+'</td>\
                                    <td><img src="dashbord/image/team_image/'+item.image+'" width="50px" height="50px" alt=""></td>\
                                    <td><button type="button" value="'+item.id+'" class="edit_btn btn btn-success btn-tone"><i class="anticon anticon-edit"></i></button>\
                                    <button type="button" value="'+item.id+'" class="delete_btn btn btn-danger btn-tone"><i class="anticon anticon-delete"></i></button></td>\
                                </tr>');
                        });
                    }
                });
            }

            //Edit team data
            $(document).on('click','.edit_btn', function(e){
                e.preventDefault();

                var emp_id = $(this).val();
                $('#editModalCenter').modal('show');

                $.ajax({
                    url: "/team-edit/"+emp_id,
                    method: "GET",
                    success: function (response) {
                        if (response.status == 404) {
                            alertify.set('notifier','position','top-right');
                            alertify.success(response.message);
                            $('#editModalCenter').modal('hide');
                        }else{
                            $('#edit_name').val(response.team.name);
                            $('#edit_position').val(response.team.position);
                            $('#emp_id').val(emp_id);
                        }
                    }
                });

            });

            //update team data
            $(document).on('submit','#updateTeamForm', function(e){
                e.preventDefault();

                var id = $('#emp_id').val();
                let updateFormData = new FormData($('#updateTeamForm')[0]);

                $.ajax({
                    url: "/team-update/"+id,
                    method: "POST",
                    data: updateFormData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == 400) {
                            $('#update_error_list').html("");
                            $('#update_error_list').removeClass('d-none');
                            $.each(response.errors, function (key, err_value){
                                $('#update_error_list').append('<li>'+err_value+'</li>');
                            });
                        }else if(response.status == 404){
                            alertify.set('notifier','position','top-right');
                            alertify.success(response.message);
                        }else if(response.status == 200){
                            $('#update_error_list').html("");
                            $('#update_error_list').addClass('d-none');
                            $('#updateTeamForm').find('input').val('');
                            $('#editModalCenter').modal('hide');

                            alertify.set('notifier','position','top-right');
                            alertify.success(response.message);

                            TeamData();
                        }
                    }
                });

            });

            //Modal show for delete team data
            $(document).on('click','.delete_btn', function(e){
                e.preventDefault();

                var emp_id = $(this).val();
                $('#DeleteModalCenter').modal('show');
                $('#delete_team_id').val(emp_id);

            });

            //Delete team data
            $(document).on('click','.delete_model_btn', function(e){
                e.preventDefault();

                var id = $('#delete_team_id').val();

                $.ajax({
                    url: "/team-delete/"+id,
                    method: "DELETE",
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 404) {

                            $('#DeleteModalCenter').modal('hide');
                            alertify.set('notifier','position','top-right');
                            alertify.success(response.message);

                        }else if(response.status == 200){

                            TeamData();

                            $('#DeleteModalCenter').modal('hide');
                            alertify.set('notifier','position','top-right');
                            alertify.success(response.message);

                        }
                    }
                });

            });

            //data store here
            $(document).on('submit','#addTeamForm', function(e){
                e.preventDefault();

                let formData = new FormData($('#addTeamForm')[0]);

                $.ajax({
                    url: "/team-store",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == 400) {
                            $('#save_error_list').html("");
                            $('#save_error_list').removeClass('d-none');
                            $.each(response.errors, function (key, err_value){
                                $('#save_error_list').append('<li>'+err_value+'</li>');
                            });
                        }else if(response.status == 200){
                            $('#save_error_list').html("");
                            $('#save_error_list').addClass('d-none');
                            $('#addTeamForm').find('input').val('');
                            $('#exampleModalCenter').modal('hide');

                            TeamData();

                            alertify.set('notifier','position','top-right');
                            alertify.success(response.message);
                        }
                    }
                });
            });
        });

    </script>
@endsection
