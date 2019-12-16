<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo $subject->subject_name; ?> ( <?php echo $subject->school_year; ?> ) Students
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li>Subjects</li>
            <li class="active">Students</li>
        </ol>
    </section>

    <span id="subject_teacher_id" data-value="<?php echo $subject_teacher_id; ?>"></span>
    <span id='gradings' data-value='<?php echo json_encode($gradings); ?>'></span>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="studentTable" class="table table-bordered table-hover">
                            <thead>
                                <th>Student</th>
                                <th>Grades
                                    <?php
                                        $classes = ['grade-primary', 'grade-secondary', 'grade-success', 'grade-info'];
                                        $num = 0;
                                        foreach ($gradings as $grading) {
                                            echo "<span class='student-grade-header ".$classes[$num]."'>".$grading->period."</span>";
                                            $num++;
                                        }
                                    ?>
                                </th>
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

<!-- Sheet -->
<div class="modal fade" id="sheet">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Select Period</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="sheetForm">
                <input type="hidden" id="subject_student_id" name="subject_student_id">
                <div class="form-group">
                  	<label for="grading_id" class="col-sm-3 control-label">Period</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="grading_id" name="grading_id" style="width:100%;" required>
                      </select>
                      <label id="grading_id-error" class="error" for="grading_id"></label>
                  	</div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-arrow-right"></i> Go</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
