</div>
<script src="<?php echo base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/alertify/js/alertify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

<?php
	if ($active == 'admin-admins') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/admin.js"></script>
		<?php
	}	
	if ($active == 'admin-teachers') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/teacher.js"></script>
		<?php
	}
	if ($active == 'admin-students') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/student.js"></script>
		<?php
	}
	if ($active == 'admin-parents') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/parent.js"></script>
		<?php
	}
	if ($active == 'admin-subjects') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/subject.js"></script>
		<?php
	}
	if ($active == 'admin-gradings') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/grading.js"></script>
		<?php
	}
	if ($active == 'admin-years') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/year.js"></script>
		<?php
	}
	if ($active == 'admin-subject-teachers') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/subject-teacher.js"></script>
		<?php
	}
	if ($active == 'admin-subject-students') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/subject-student.js"></script>
		<?php
	}
	if ($active == 'admin-parent-students') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/parent-student.js"></script>
		<?php
	}	
	if ($active == 'admin-profile') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/admin/profile.js"></script>
		<?php
	}					
?>
</body>
</html>