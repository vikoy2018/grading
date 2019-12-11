<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-list-alt"></i> Criterias for <?php echo $subject->subject_name; ?> ( <?php echo $subject->school_year; ?> )
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li>Subjects</li>
            <li class="active">Criterias</li>
        </ol>
    </section>

    <span id="subject_teacher_id" data-value="<?php echo $subject_teacher_id; ?>"></span>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a> 
                        <span style="float:right; padding-top: 6px;"><strong>Note:</strong> Total criteria percentage should be equal to 100%</span>
                    </div>
                    <div class="box-body">
                        <table id="criteriaTable" class="table table-bordered table-hover">
                            <thead>
                                <th>Criteria</th>
                                <th>Percentage</th>
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
            	<h4 class="modal-title"><b>Add Criteria</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="criteriaForm">
                <input type="hidden" id="subject_teacher_id" name="subject_teacher_id" value="<?php echo $subject_teacher_id; ?>">
                <div class="form-group">
                  	<label for="criteria" class="col-sm-3 control-label">Criteria</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="criteria" name="criteria" required>
                  	</div>
                </div>
                <div class="form-group has-feedback">
                  	<label for="percentage" class="col-sm-3 control-label">Percentage</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="percentage" name="percentage" required>
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
            	<h4 class="modal-title"><b>Edit Criteria</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="editCriteriaForm">
            	<input type="hidden" id="criteria_id" name="criteria_id">
                <div class="form-group">
                  	<label for="edit_criteria" class="col-sm-3 control-label">Criteria</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_criteria" name="edit_criteria" required>
                  	</div>
                </div>
                <div class="form-group has-feedback">
                  	<label for="edit_percentage" class="col-sm-3 control-label">Percentage</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_percentage" name="edit_percentage" required>
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
            	<h4 class="modal-title"><b>Delete Criteria</b></h4>
          	</div>
          	<div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure you want to delete criteria?</h4>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="button" class="btn btn-danger btn-flat" id="deleteCriteria"><i class="fa fa-trash"></i> Delete</button>
          	</div>
        </div>
    </div>
</div>