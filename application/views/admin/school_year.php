<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar"></i> School Years
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li class="active">School Years</li>
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
                        <table id="yearTable" class="table table-bordered table-striped dt-responsive nowrap">
                            <thead>
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
            	<h4 class="modal-title"><b>Add School Year</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="yearForm">
                <div class="form-group">
                  	<label for="school_year" class="col-sm-3 control-label">School Year</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="school_year" name="school_year" required>
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
            	<h4 class="modal-title"><b>Edit School Year</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="editYearForm">
                <input type="hidden" id="yearid" name="yearid">
                <div class="form-group">
                  	<label for="edit_school_year" class="col-sm-3 control-label">School Year</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_school_year" name="edit_school_year" required>
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
            	<h4 class="modal-title"><b>Delete School Year</b></h4>
          	</div>
          	<div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure you want to delete school year?</h4>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="button" class="btn btn-danger btn-flat" id="deleteYear"><i class="fa fa-trash"></i> Delete</button>
          	</div>
        </div>
    </div>
</div>