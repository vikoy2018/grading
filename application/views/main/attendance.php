<div class="login-box">
  	<div class="login-logo">
  	    <p id="date"></p>
        <p id="time" class="bold"></p>
  	</div>
  
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Member Attendance</h4>

    	<form id="attendance">
			<div class="form-group">
				<select class="form-control" name="consolidation_place" id="consolidation_place">
					<?php
						foreach ($consolidation_place as $place) {
							?>
							<option value="<?php echo $place->id; ?>"><?php echo $place->place; ?></option>
							<?php
						}
					?>
				</select>
			</div>
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="member" name="member" placeholder="Member ID" required>
				<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
				<label id="member-error" class="error" for="member"></label>
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Submit</button>
        		</div>
      		</div>
    	</form>
  	</div>	
</div>