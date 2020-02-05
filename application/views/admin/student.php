<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-circle-o"></i> Students
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li>Users</li>
            <li class="active">Students</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
                    </div>
                    <div class="box-body">
                        <table id="studentTable" class="table table-bordered table-striped dt-responsive nowrap">
                            <thead>
                                <th>Student ID</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Photo</th>
                                <th>Parent</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>
    </section>
    <!-- /.content -->

</div>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Student</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="studentForm">
                <div class="form-group">
                    <label for="school_id" class="col-sm-3 control-label">Student ID</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="school_id" name="school_id" required>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="username" class="col-sm-3 control-label">Username</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="username" name="username" required>
                  	</div>
                </div>
                <div class="form-group has-feedback">
                  	<label for="firstname" class="col-sm-3 control-label">Firstname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="firstname" name="firstname" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="lastname" class="col-sm-3 control-label">Lastname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="lastname" name="lastname" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Student</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="editStudentForm">
            	<input type="hidden" id="studentid" name="studentid">
                <input type="hidden" id="userid" name="userid">
                <div class="form-group">
                    <label for="edit_school_id" class="col-sm-3 control-label">Student ID</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_school_id" name="edit_school_id" required>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_username" class="col-sm-3 control-label">Username</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_username" name="edit_username" required>
                  	</div>
                </div>
                <div class="form-group has-feedback">
                  	<label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_firstname" name="edit_firstname" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_lastname" name="edit_lastname" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="edit_photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" class="form-control" id="edit_photo" name="edit_photo">
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Delete Student</b></h4>
          	</div>
          	<div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure you want to delete student?</h4>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="button" class="btn btn-danger btn-flat" id="deleteStudent"><i class="fa fa-trash"></i> Delete</button>
          	</div>
        </div>
    </div>
</div>

<!-- Form 138 -->
<div class="modal fade" id="form138">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Select School Year</b></h4>
          	</div>
          	<div class="modal-body">
                <form class="form-horizontal" id="f138Form">
                    <input type="hidden" id="student_id" name="student_id">
                    <div class="form-group">
                        <label for="school_year_id" class="col-sm-3 control-label">School Year</label>

                        <div class="col-sm-9">
                        <select class="form-control" id="school_year_id" name="school_year_id" style="width:100%;" required>
                        </select>
                        <label id="school_year_id-error" class="error" for="school_year_id"></label>
                        </div>
                    </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-arrow-right"></i> Go</button>
          	</div>
        </div>
    </div>
</div>