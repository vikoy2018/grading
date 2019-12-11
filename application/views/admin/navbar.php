<header class="main-header">
    <a href="<?php echo base_url(); ?>admin/home" class="logo">
        <span class="logo-mini"><b>EVAA</b></span>
        <span class="logo-lg"><b>East Visayan</b></span>
    </a>
   
    <nav class="navbar navbar-static-top">
        
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    
                    <img src="<?php echo $user->photo ? base_url('uploads/'.$user->photo) : base_url('assets/img/avatar.png'); ?>" class="user-image" alt="User Image">
                    
                    <span class="hidden-xs"><?php echo ucfirst($user->firstname).' '.ucfirst($user->lastname); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="<?php echo $user->photo ? base_url('uploads/'.$user->photo) : base_url('assets/img/avatar.png'); ?>" class="img-circle" alt="User Image">
                        <p>
                        <?php echo ucfirst($user->firstname).' '.ucfirst($user->lastname); ?>
                        
                        <small>Member since <?php echo date('M Y', strtotime($user->created_on)); ?></small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?php echo base_url(); ?>admin/profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo base_url(); ?>admin/logout" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>