<header id="mu-header" class="noprint">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="mu-header-area">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div class="mu-header-top-left">
                <div class="mu-top-email">
                  <i class="fa fa-envelope"></i>
                  <span>eastvisayan2019@gmail.com</span>
                </div>
                <div class="mu-top-phone">
                  <i class="fa fa-phone"></i>
                  <span>09264837405</span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div class="mu-header-top-right">
                <nav>
                  <ul class="mu-top-social-nav">
                    <li><a href="<?php echo base_url('parent/profile'); ?>"><span class="fa fa-user"></span> <?php echo $user->firstname.' '.$user->lastname; ?></a></li>
                    <li><a href="<?php echo base_url('parent/logout'); ?>"><span class="fa fa-sign-out"></span> Logout</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<section id="mu-menu" class="noprint">
  <nav class="navbar navbar-default" role="navigation">  
    <div class="container">
      <div class="navbar-header">
        <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- LOGO -->              
        <!-- TEXT BASED LOGO -->
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/img/logo.png'); ?>"><span>East Visayan</span></a>
        <!-- IMG BASED LOGO  -->
        <!-- <a class="navbar-brand" href="index.html"><img src="assets/frontend//img/logo.png" alt="logo"></a> -->
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
          <li class="<?php echo $active == 'home' ? 'active' : ''; ?>"><a href="<?php echo base_url('parent'); ?>">Home</a></li>                                 
          <li class="<?php echo $active == 'parent-contact' ? 'active' : ''; ?>"><a href="<?php echo base_url('parent/contact'); ?>">Contact</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Grades <span class="fa fa-angle-down"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php
                foreach ($students as $student) {
                  ?>
                  <li><a href="<?php echo base_url(); ?>parent/grade/<?php echo $student->student_id; ?>"><?php echo $student->firstname.' '.$student->lastname; ?></a></li> 
                  <?php
                } 
              ?>                
            </ul>
          </li> 
        </ul>                     
      </div><!--/.nav-collapse -->        
    </div>     
  </nav>
</section>