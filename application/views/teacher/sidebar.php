<aside class="main-sidebar">
    
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $user->photo ? base_url('uploads/'.$user->photo) : base_url('assets/img/avatar.png'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo ucfirst($user->firstname).' '.ucfirst($user->lastname); ?></p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo $active == 'teacher-dashboard' ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>teacher/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="<?php echo $active == 'teacher-subjects' ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>teacher/subjects"><i class="fa fa-book"></i> <span>Subjects</span></a>
            </li>
        </ul>
    </section>
    
  </aside>