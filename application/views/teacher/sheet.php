<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      
    <title><?php echo $title; ?> | East Visayan Academy</title>
  
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/dist/css/bootstrap.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/alertify/css/alertify.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

</head>
<body>
<span class="base_url" data-value="<?php echo base_url(); ?>"></span>
<div id="loader">
	<div id="loader-image"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<div class="container-fluid">
  <div class="sheet-title text-center">
    <p class="subject-title"><?php echo $subject->subject_name.' ( '.$subject->school_year.' )'; ?></p>
    <p class="student-title"><strong><?php echo $student->firstname.' '.$student->lastname; ?></strong></p>
    <p class="period-title"><?php echo $grading->period; ?></p>
  </div>
  <?php
    $error = false;
  ?>
  <div class="form-table">
    <?php 
      if (count($criterias) < 1 ) {
        $error = true;
        ?>
        <table class="table table-bordered">
          <td class="text-center color-red"><h4><i class="fa fa-exclamation"></i> Please add criteria for the subject first</h4></td>
        </table>
        <?php
      } else {
        ?>
        <form id="scoreStudentForm">
        <input type="hidden" value="<?php echo $student->id; ?>" name="student_id">
        <input type="hidden" value="<?php echo $grading->id; ?>" name="grading_id">
        <input type="hidden" value="<?php echo $subject_student_id; ?>" name="subject_student_id">
        <table class="table table-bordered">
            <tr>
            <td class="table-marker text-center"><strong>Criteria</strong></td>
            <?php
              foreach ($criterias as $criteria) {
                if (property_exists($criteria, 'scores')) {
                  $scores_count = count($criteria->scores);
                  ?>
                  <td class="text-center table-header" colspan="<?php echo $scores_count; ?>"><strong><?php echo $criteria->criteria; ?></strong></td>
                  <?php
                } else {
                  $error = true;
                  ?>
                  <td class="text-center table-header"><strong><?php echo $criteria->criteria; ?></strong></td>
                  <?php
                }
                
              }
            ?>
            <tr>
            <tr>
            <td class="table-marker text-center"><strong>Total Score</strong></td>
            <?php
              foreach ($criterias as $criteria) {
                if (property_exists($criteria, 'scores')) {
                  foreach ($criteria->scores as $score) {
                    if (property_exists($score, 'total_score')) {
                      ?>
                      <td class="text-center"><strong><?php echo $score->total_score; ?></strong></td>
                      <?php
                    } else {
                      $error = true;
                      ?>
                      <td class="text-center"></td>
                      <?php
                    }
                  }
                } else {
                  $error = true;
                  ?>
                  <td class="text-center color-red"><i class="fa fa-exclamation"></i> Please add score for criteria</td>
                  <?php
                }
              }
            ?>
            </tr>
            <tr>
            <td class="table-marker text-center <?php echo !$submitted ? 'score-marker' : ''; ?>"><strong>Score</strong></td>
            <?php
              foreach ($criterias as $criteria) {
                if (property_exists($criteria, 'scores')) {
                  foreach ($criteria->scores as $score) {
                    $show_span = 'hideme';
                    $show_input = '';
                    if ($submitted) {
                      $show_span = '';
                      $show_input = 'hideme';
                    }
                    ?>
                    <td class="text-center">
                      <input type="hidden" value="<?php echo $score->id; ?>" name="criteria_score_id[]">
                      <span class="<?php echo $show_span; ?>"><?php echo (count($score->student_score) > 0) ? $score->student_score[0]->score : 0; ?></span>
                      <input type="text" class="form-control <?php echo $show_input; ?>" value="<?php echo (count($score->student_score) > 0) ? $score->student_score[0]->score : 0; ?>" name="score[]">
                    </td>
                    <?php
                  }
                } else {
                  $error = true;
                  ?>
                  <td class="text-center"></td>
                  <?php
                }
              }
            ?>
            </tr>
        </table>
        <?php
          if (!$error) {
            ?>
            <div class="sheet-buttons <?php echo $submitted ? 'hideme' : ''; ?>">
              <button type="submit" class="btn btn-primary btn-flat btn-lg"><i class="fa fa-save"></i> Save</button>
              <button type="button" class="btn btn-info btn-flat btn-lg" data-toggle="modal" data-target="#preview"><i class="fa fa-eye"></i> Grade</button> <button type="button" class="btn btn-success btn-flat btn-lg" data-toggle="modal" data-target="#submit"><i class="fa fa-pencil"></i> Submit</button>
            </div>
            <?php
          }
        ?>
        </form>
        <?php
      }
    ?>
    
  </div>
  <!-- Sheet -->
  <div class="modal fade" id="submit">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Submit Grade</b></h4>
              </div>
              <div class="modal-body">
                <h4 class="text-center">Are you sure you want to submit grade?</h4>
                <p class="text-center">You can't edit grade if submitted.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="button" class="btn btn-success btn-flat" id="submitGrade"><i class="fa fa-check"></i> Yes</button>
                </form>
              </div>
          </div>
      </div>
  </div>

  <!-- Preview Grade -->
  <div class="modal fade" id="preview">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Preview Grade</b></h4>
              </div>
              <div class="modal-body">
                <h4 class="text-center">Save scores and preview grade?</h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="button" class="btn btn-success btn-flat" id="previewGrade"><i class="fa fa-check"></i> Yes</button>
                </form>
              </div>
          </div>
      </div>
  </div>

  <!-- Grade -->
  <div class="modal fade" id="grade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Grade</b></h4>
              </div>
              <div class="modal-body">
                <h4 class="text-center"><span id="student_grade">0</span></h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </form>
              </div>
          </div>
      </div>
  </div>

</div>

<script src="<?php echo base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/alertify/js/alertify.min.js"></script>
<script>
  $(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    $('#scoreStudentForm').submit(function(e){
      e.preventDefault();
      var scores = $(this).serialize();
      $.ajax({
        type: "POST",
        url: base_url+'teacherController/SaveScores',
        data: scores,
        dataType: 'json',
        beforeSend: function(){
          $('#loader').show();
        },
        success: function(data){
          $('#loader').hide();
          if(!data.error){
            alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
          } else {
            alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
          }
        }
      });
    });

    $('#submitGrade').click(function(e){
      var scores = $('#scoreStudentForm').serialize();
      $.ajax({
        type: "POST",
        url: base_url+'teacherController/submitGrade',
        data: scores,
        dataType: 'json',
        beforeSend: function(){
          $('#loader').show();
        },
        success: function(data){
          $('#loader').hide();
          if(!data.error){
            window.location.reload();
          } else {
            alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
          }
        }
      });
    });

    $('#previewGrade').click(function(e){
      var scores = $('#scoreStudentForm').serialize();
      $.ajax({
        type: "POST",
        url: base_url+'teacherController/previewGrade',
        data: scores,
        dataType: 'json',
        beforeSend: function(){
          $('#loader').show();
        },
        success: function(data){
          $('#loader').hide();
          if(!data.error){
            $('#preview').modal('hide');
            $('#student_grade').html(data.grade);
            $('#grade').modal('show');
          } else {
            alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
          }
        }
      });
    });

  });
</script>

</body>
</html>