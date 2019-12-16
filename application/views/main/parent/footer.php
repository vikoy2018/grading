	<footer id="mu-footer">
	<!-- start footer bottom -->
	<div class="mu-footer-bottom">
	  <div class="container">
	    <div class="mu-footer-bottom-area">
	      <p>&copy; All Right Reserved. East Visayan Adventist Academy</p>
	    </div>
	  </div>
	</div>
	<!-- end footer bottom -->
	</footer>

	<!-- jQuery library -->
  	<script src="assets/frontend/js/jquery.min.js"></script>  
  	<!-- Include all compiled plugins (below), or include individual files as needed -->
  	<script src="assets/frontend/js/bootstrap.js"></script>   
  	<!-- Slick slider -->
  	<script type="text/javascript" src="assets/frontend/js/slick.js"></script>
  	<!-- Counter -->
  	<script type="text/javascript" src="assets/frontend/js/waypoints.js"></script>
  	<script type="text/javascript" src="assets/frontend/js/jquery.counterup.js"></script>  
  	<!-- Mixit slider -->
  	<script type="text/javascript" src="assets/frontend/js/jquery.mixitup.js"></script>
  	<!-- Add fancyBox -->        
  	<script type="text/javascript" src="assets/frontend/js/jquery.fancybox.pack.js"></script>
  
	<script src="<?php echo base_url(); ?>assets/alertify/js/alertify.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

  	<!-- Custom js -->
  	<script src="assets/frontend/js/custom.js"></script> 

	<?php
		if ($active == 'login') {
			?>
			<script src="assets/js/main/login.js"></script> 
			<?php
		}
	?>

  	</body>
</html>