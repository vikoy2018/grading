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
            <li class="<?php echo $active == 'admin-dashboard' ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="<?php echo $active == 'admin-admins' || $active == 'admin-teachers' || $active =='admin-students' || $active == 'admin-parents' ? 'menu-open active' : ''; ?> treeview" >
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu" <?php echo $active == 'admin-admins' || $active == 'admin-teachers' || $active =='admin-students' || $active == 'admin-parents' ? "style='display: block;'" : ""; ?>>
                    <li class="<?php echo $active == 'admin-admins' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>admin/admins"><i class="fa fa-circle-o"></i> <span>Admins</span></a>
                    </li> 
                    <li class="<?php echo $active == 'admin-teachers' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>admin/teachers"><i class="fa fa-circle-o"></i> <span>Teachers</span></a>
                    </li>
                    <li class="<?php echo $active == 'admin-students' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>admin/students"><i class="fa fa-circle-o"></i> <span>Students</span></a>
                    </li>
                    <li class="<?php echo $active == 'admin-parents' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>admin/parents"><i class="fa fa-circle-o"></i> <span>Parents</span></a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo $active == 'admin-subjects' ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>admin/subjects"><i class="fa fa-book"></i> <span>Subjects</span></a>
            </li>
            <li class="<?php echo $active == 'admin-gradings' ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>admin/gradings"><i class="fa fa-tasks"></i> <span>Gradings</span></a>
            </li>
            <li class="<?php echo $active == 'admin-years' ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>admin/school-years"><i class="fa fa-calendar"></i> <span>School Years</span></a>
            </li>
            <li class="<?php echo $active == 'admin-subject-teachers' ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>admin/subject-teachers"><i class="fa fa-user-secret"></i> <span>Subject Teachers</span></a>
            </li>
        </ul>
    </section>
    
  </aside>