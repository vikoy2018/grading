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
  <div class="form-table">
    <form id="scoreStudentForm">
    <input type="hidden" value="<?php echo $student->id; ?>" name="student_id">
    <table class="table table-bordered">
        <tr>
        <td class="table-marker text-center"><strong>Criteria</strong></td>
        <?php
          foreach ($criterias as $criteria) {
            $scores_count = count($criteria->scores);
            ?>
            <td class="text-center table-header" colspan="<?php echo $scores_count; ?>"><strong><?php echo $criteria->criteria; ?></strong></td>
            <?php
          }
        ?>
        <tr>
        <tr>
        <td class="table-marker text-center"><strong>Total Score</strong></td>
        <?php
          foreach ($criterias as $criteria) {
            foreach ($criteria->scores as $score) {
              ?>
              <td class="text-center"><strong><?php echo $score->total_score; ?></strong></td>
              <?php
            }
          }
        ?>
        </tr>
        <tr>
        <td class="table-marker text-center score-marker"><strong>Score</strong></td>
        <?php
          foreach ($criterias as $criteria) {
            foreach ($criteria->scores as $score) {
              ?>
              <td class="text-center">
                <input type="hidden" value="<?php echo $score->id; ?>" name="criteria_score_id[]">
                <input type="text" class="form-control" value="<?php echo (count($score->student_score) > 0) ? $score->student_score[0]->score : 0; ?>" name="score[]">
              </td>
              <?php
            }
          }
        ?>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary btn-flat btn-lg" style="float:right;"><i class="fa fa-save"></i> Save</button>
    </form>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
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
  });
</script>

</body>
</html>