<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calculator"></i> Score for <?php echo $score->subject_name; ?> [<?php echo $score->criteria; ?>] ( <?php echo $score->school_year; ?> )
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li>Subjects</li>
            <li>Criterias</li>
            <li class="active">Scores</li>
        </ol>
    </section>

    <span id="subject_criteria_id" data-value="<?php echo $subject_criteria_id; ?>"></span>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat" id="addScore"><i class="fa fa-plus"></i> New</a> 
                    </div>
                    <div class="box-body">
                        <table id="scoreTable" class="table table-bordered table-hover">
                            <thead>
                                <th>Period</th>
                                <th>Total Score</th>
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
            	<h4 class="modal-title"><b>Add Score</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="scoreForm">
                <input type="hidden" id="subject_criteria_id" name="subject_criteria_id" value="<?php echo $subject_criteria_id; ?>">
                <div class="form-group">
                  	<label for="grading_id" class="col-sm-3 control-label">Period</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="grading_id" name="grading_id" style="width:100%" required>
                      </select>
                      <label id="grading_id-error" class="error" for="grading_id"></label>
                  	</div>
                </div>
                <div class="form-group has-feedback">
                  	<label for="total_score" class="col-sm-3 control-label">Total Score</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="total_score" name="total_score" required>
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
            	<h4 class="modal-title"><b>Edit Score</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="editScoreForm">
            	<input type="hidden" id="score_id" name="score_id">
                <div class="form-group">
                    <label for="edit_grading_id" class="col-sm-3 control-label">Period</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="edit_grading_id" name="edit_grading_id" style="width:100%" required>
                      </select>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="edit_total_score" class="col-sm-3 control-label">Total Score</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_total_score" name="edit_total_score" required>
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
            	<h4 class="modal-title"><b>Delete Score</b></h4>
          	</div>
          	<div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure you want to delete score?</h4>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="button" class="btn btn-danger btn-flat" id="deleteScore"><i class="fa fa-trash"></i> Delete</button>
          	</div>
        </div>
    </div>
</div>