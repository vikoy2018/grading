<section class="grade-section page-content">
    <div class="container">
        <span id="student_id" data-value="<?php echo $mystudent->id; ?>"></span>
        <div class="grader-div">
            <div class="grade-header">
                <div class="grade-logo1">
                    <img src="<?php echo base_url('assets/img/logo.png'); ?>">
                </div>
                <div class="text-center grade-school">
                    <p class="grade-header-title">EAST VISAYAN ADVENTIST ACADEMY OF LEYTE, INC.</p>
                    <p class="grade-header-subtitle">EVAA Heights, San Sotero, Javier, Leyte – 6511</p>
                </div>
                <div class="grade-logo2">
                    <img src="<?php echo base_url('assets/img/logo1.png'); ?>">
                </div>
                <div id="school_year" class="noprint">
                    <select class="" id="select_school_year">
                        <?php
                            foreach ($school_years as $year) {
                                $select = '';
                                if ($year->school_year_id == $school_year->school_year_id) {
                                    $select = 'selected';
                                }
                                ?>
                                <option value="<?php echo $year->school_year_id; ?>" <?php echo $select; ?>><?php echo $year->school_year; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div id="print_grade" class="noprint">
                    <button type="button" class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="grade-student">
                <table>
                    <tr>
                        <td>Student ID No.:</td>
                        <td><?php echo $mystudent->school_id; ?></td>
                        <td>School Year:</td>
                        <td><?php echo $school_year->school_year; ?></td>
                    </tr>
                    <tr>
                        <td>Student Name:</td>
                        <td><?php echo $mystudent->firstname.' '.$mystudent->lastname; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="grade-table">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-center">SUBJECT</td>
                        <?php
                            foreach ($gradings as $grading) {
                                ?>
                                <td class="text-center"><?php echo $grading->period; ?></td>
                                <?php
                            }
                        ?>
                        <td class="text-center">Final Average</td>
                    </tr>
                    <?php 
                        foreach ($student_grades as $student_grade) {
                            $total = 0;
                            ?>
                            <tr>
                                <td><?php echo $student_grade->subject_name; ?></td>
                                <?php
                                foreach ($student_grade->grades as $grade) {
                                    ?>
                                    <td><?php $total += $grade; echo $grade; ?></td>
                                    <?php
                                }
                                ?>
                                <td><?php echo $total/(count($student_grade->grades)); ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</section>