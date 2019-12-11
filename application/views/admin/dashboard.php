<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-dashboard"></i> Dashboard
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>0</h3>

                        <p>Today's Attendance</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>admin/attendance" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>0</h3>

                        <p>Members</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>admin/members" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>0</h3>

                        <p>Events</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>admin/events" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
           
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>0</h3>

                        <p>Total Attendance</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text-o"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>admin/attendance" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
        </div>
     
        <!-- Main row -->
        <!-- <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Monthly Attendance Report [<span id="attYear"></span>]</h3>
                    <div class="box-tools pull-right">
                        <form class="form-inline">
                        <div class="form-group">
                            <label>Select Year: </label>
                            <select class="form-control input-sm" id="year">
                            <?php
                                $current_year = date('Y');
                                for($i=$current_year; $i>=$current_year-10; $i--){
                                $selected = ($i==$current_year)?'selected':'';
                                echo "
                                    <option value='".$i."' ".$selected.">".$i."</option>
                                ";
                                }
                            ?>
                            </select>
                        </div>
                        </form>
                    </div>
                    </div>
                    <div class="box-body">
                    <div class="chart">
                        <br>
                        <div id="legend" class="text-center"></div>
                        <canvas id="barChart" style="height:350px"></canvas>
                    </div>
                    </div>
                </div>
            </div>
        </div> -->

    </section>
    <!-- /.content -->
  </div>