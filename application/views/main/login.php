<section class="login-section page-content">
    <div class="login-box">
        <div class="login-box-body">
            <p class="login-box-msg">Login to start your session</p>

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
                <button type="submit" class="btn btn-primary btn-block btn-flat" id="login" name="signin"><i class="fa fa-sign-in"></i> SIGN IN</button>
            </form>
        </div>	
    </div>
</section>