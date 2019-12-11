</div>
<script src="<?php echo base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/alertify/js/alertify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

<?php
	if ($active == 'teacher-subjects') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/teacher/subject.js"></script>
		<?php
	}	
	if ($active == 'teacher-criteria') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/teacher/criteria.js"></script>
		<?php
	}
	if ($active == 'teacher-criteria-score') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/teacher/score.js"></script>
		<?php
	}	
	if ($active == 'teacher-subject-students') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/teacher/subject-student.js"></script>
		<?php
	}					
?>
</body>
</html>