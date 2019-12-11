<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Child/Children of <?php echo $parent->firstname.' '.$parent->lastname; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li class="active">Parent Students</li>
        </ol>
    </section>

    <span id="parent_id" data-value="<?php echo $parent_id; ?>"></span>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat" id="addParentStudent"><i class="fa fa-plus"></i> New</a>
                    </div>
                    <div class="box-body">
                        <table id="parentstudentTable" class="table table-bordered table-striped dt-responsive nowrap">
                            <thead>
                                <th>Lastname</th>
                                <th>Firstname</th>
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
            	<form class="form-horizontal" id="parentStudentForm">
                <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $parent_id; ?>">
                <div class="form-group">
                  	<label for="student_id" class="col-sm-3 control-label">Student</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="student_id" name="student_id" required>
                      </select>
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
            	<button type="button" class="btn btn-danger btn-flat" id="deleteParentStudent"><i class="fa fa-trash"></i> Delete</button>
          	</div>
        </div>
    </div>
</div>