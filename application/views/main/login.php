<div class="login-box">
  	<div class="login-logo">
  	    <b>ADMIN LOGIN</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to start your session</p>

    	<form id="loginForm">
            <div class="form-group has-feedback">
                <input type="text" class="form-control input-lg" id="username" name="username" placeholder="Username" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <label id="username-error" class="error" for="username"></label>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <label id="password-error" class="error" for="password"></label>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Submit</button>
                </div>
            </div>
    	</form>
  	</div>	
</div>