<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i> Subjects
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li class="active">Subjects</li>
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
                        <table id="subjectTable" class="table table-bordered table-hover">
                            <thead>
                                <th>Subject Name</th>
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
            	<h4 class="modal-title"><b>Add Subject</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="subjectForm">
                <div class="form-group">
                  	<label for="subject_name" class="col-sm-3 control-label">Subject</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="subject_name" name="subject_name" required>
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
            	<h4 class="modal-title"><b>Edit Subject</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="editSubjectForm">
                <input type="hidden" id="subjectid" name="subjectid">
                <div class="form-group">
                  	<label for="edit_subject_name" class="col-sm-3 control-label">Subject</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_subject_name" name="edit_subject_name" required>
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
            	<h4 class="modal-title"><b>Delete Subject</b></h4>
          	</div>
          	<div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure you want to delete subject?</h4>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="button" class="btn btn-danger btn-flat" id="deleteSubject"><i class="fa fa-trash"></i> Delete</button>
          	</div>
        </div>
    </div>
</div>