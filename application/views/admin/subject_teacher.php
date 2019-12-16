<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-secret"></i> Subject Teachers
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li class="active">Subject Teachers</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat" id="addSubjectTeacher"><i class="fa fa-plus"></i> New</a>
                    </div>
                    <div class="box-body">
                        <table id="subjectteacherTable" class="table table-bordered table-striped dt-responsive nowrap">
                            <thead>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>School Year</th>
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
            	<h4 class="modal-title"><b>Add Subject Teacher</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="subjectTeacherForm">
                <div class="form-group">
                  	<label for="subject_id" class="col-sm-3 control-label">Subject</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="subject_id" name="subject_id" style="width:100%;" required>
                      </select>
                      <label id="subject_id-error" class="error" for="subject_id"></label>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="teacher_id" class="col-sm-3 control-label">Teacher</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="teacher_id" name="teacher_id" style="width:100%;" required>
                      </select>
                      <label id="teacher_id-error" class="error" for="teacher_id"></label>
                    </div>
                </div>
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
            	<h4 class="modal-title"><b>Edit Subject Teacher</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="editSubjectTeacherForm">
                <input type="hidden" id="subjectteacherid" name="subjectteacherid">
                <div class="form-group">
                    <label for="edit_subject_id" class="col-sm-3 control-label">Subject</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="edit_subject_id" name="edit_subject_id" style="width:100%;" required>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_teacher_id" class="col-sm-3 control-label">Teacher</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="edit_teacher_id" name="edit_teacher_id" style="width:100%;" required>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_school_year_id" class="col-sm-3 control-label">School Year</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="edit_school_year_id" name="edit_school_year_id" style="width:100%;" required>
                      </select>
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
            	<h4 class="modal-title"><b>Delete Subject Teacher</b></h4>
          	</div>
          	<div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure you want to delete subject teacher?</h4>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="button" class="btn btn-danger btn-flat" id="deleteSubjectTeacher"><i class="fa fa-trash"></i> Delete</button>
          	</div>
        </div>
    </div>
</div>