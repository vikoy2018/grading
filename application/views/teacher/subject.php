<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i> Subjects
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-calendar"></i> Home</a></li>
            <li class="active">Subjects</li>
        </ol>
    </section>

    <span id="teacher_id" data-value="<?php echo $user->id; ?>"></span>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="subjectTable" class="table table-bordered table-hover">
                            <thead>
                                <th>Subject Name</th>
                                <th>School Year</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>
    </section>
    <!-- /.content -->

</div>