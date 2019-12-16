<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>teacher/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-body profile-box">
                <div class="row">
                    <div class="col-xs-3">
                        <img class="profile-image thumbnail" src="<?php echo !empty($user->photo) ? base_url('uploads/'.$user->photo) :  base_url('assets/img/avatar.png'); ?>">
                    </div>  
                    <div class="col-xs-9">
                        <form class="form-horizontal" id="profileForm">
                            <input type="hidden" id="teacher_id" name="teacher_id" value="<?php echo $user->id; ?>">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user->user_id; ?>">
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label profile-label">Username</label>

                                <div class="col-sm-9">
                                  <input type="text" class="form-control input-lg" id="username" name="username" value="<?php echo $user->username; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label profile-label">Password</label>

                                <div class="col-sm-9">
                                  <input type="password" class="form-control input-lg" id="password" name="password"
                                  value="<?php echo $user->password; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="col-sm-3 control-label profile-label">Firstname</label>

                                <div class="col-sm-9">
                                  <input type="text" class="form-control input-lg" id="firstname" name="firstname" value="<?php echo $user->firstname; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label profile-label">Lastname</label>

                                <div class="col-sm-9">
                                  <input type="text" class="form-control input-lg" id="lastname" name="lastname" value="<?php echo $user->lastname; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="col-sm-3 control-label profile-label">Photo</label>

                                <div class="col-sm-9">
                                  <input type="file" class="form-control input-lg" id="photo" name="photo">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg profile-btn"><i class="fa fa-save"></i> Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!-- /.content -->

</div>

<!-- Password -->
<div class="modal fade" id="passwordCheck">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Password Check</b></h4>
          	</div>
          	<div class="modal-body">
                <p class="text-center">Please input current password to save changes</p>
            	<form class="form-horizontal" id="passwordForm">
                <div class="form-group">
                  	<label for="prof_password" class="col-sm-3 control-label">Password</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="prof_password" name="prof_password" required>
                  	</div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>