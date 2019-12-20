<?php 
if ($active == 'home') {
  ?>
  <section id="mu-slider">
    <div class="mu-slider-single">
      <div class="mu-slider-img slider1">
      </div>
      <div class="mu-slider-content">
        <h4>Welcome To East Visayan</h4>
        <span></span>
        <h2>We Will Help You To Learn</h2>
      </div>
    </div>
    
    <div class="mu-slider-single">
      <div class="mu-slider-img slider2">
      </div>
      <div class="mu-slider-content">
        <h4>Quality Teachers</h4>
        <span></span>
        <h2>Learn from our professional teachers</h2>
      </div>
    </div>
    <div class="mu-slider-single">
      <div class="mu-slider-img slider3">
      </div>
      <div class="mu-slider-content">
        <h4>Online Grading System</h4>
        <span></span>
        <h2>You can view your grades online</h2>
      </div>
    </div>  
  </section>

  <section id="mu-service">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-service-area">
            <div class="mu-service-single">
              <span class="fa fa-tasks"></span>
              <h3>Online Grades</h3>
              <p>Students and parents can view the grades online</p>
            </div>
            <div class="mu-service-single">
              <span class="fa fa-users"></span>
              <h3>Quality Teachers</h3>
              <p>Learn for our well experience teachers that provide quality education</p>
            </div>
            <div class="mu-service-single">
              <span class="fa fa-table"></span>
              <h3>Best Environment</h3>
              <p>Its best to learn if your environment provides excitement and happiness.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
} else {
  ?>
  <section id="mu-page-breadcrumb" class="noprint">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-page-breadcrumb-area">
            <h2><?php echo $title; ?></h2>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>">Home</a></li>            
              <li class="active"><?php echo $title; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
}