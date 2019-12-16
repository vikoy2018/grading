<script src="<?php echo base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/alertify/js/alertify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<?php
	if ($active == 'admin-login') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/main/admin-login.js"></script>
		<?php
	}
	if ($active == 'teacher-login') {
		?>
		<script src="<?php echo base_url(); ?>assets/js/main/teacher-login.js"></script>
		<?php
	}
?>
</body>
</html>