<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      
    <title><?php echo $title; ?> | East Visayan Academy</title>
  
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/dist/css/bootstrap.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/alertify/css/alertify.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link href="<?php echo base_url('assets/css/print.css'); ?>" rel="stylesheet" media="print">  

</head>
<body class="form-138-body">
<span class="base_url" data-value="<?php echo base_url(); ?>"></span>
<div id="loader">
	<div id="loader-image"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<div class="container">
  <table class="form138-main-table">
    <tr>
      <td class="main-td">
        <div class="report-attendance">
          <p class="first-title text-center">REPORT ON ATTENDANCE</p>
          <table class="table table-bordered">
            <tr>
              <td></td>
              <td>Jun</td>
              <td>Jul</td>
              <td>Aug</td>
              <td>Sept</td>
              <td>Oct</td>
              <td>Nov</td>
              <td>Dec</td>
              <td>Jan</td>
              <td>Feb</td>
              <td>Mar</td>
              <td>Apr</td>
              <td>Total</td>
            </tr>
            <tr>
              <td>No. of school days</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>No. of days present</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>No. of days absent</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </table>
        </div>

        <div class="parent-signature">
         <p class="first-title text-center">PARENT/GUARDIAN'S SIGNATURE</p>
         <table>
          <tr>
            <td class="parent-signature-label w20">1st Quarter</td>
            <td class="form-content-underline"></td>
          </tr>
          <tr>
            <td class="parent-signature-label w20">2nd Quarter</td>
            <td class="form-content-underline"></td>
          </tr>
          <tr>
            <td class="parent-signature-label w20">3rd Quarter</td>
            <td class="form-content-underline"></td>
          </tr>
          <tr>
            <td class="parent-signature-label w20">4th Quarter</td>
            <td class="form-content-underline"></td>
          </tr>
         </table>
        </div>

      </td>
      <td class="main-td">

        <p class="form-header-title">DepEd FORM 138</p>
        <div class="form-header-container">
          <div class="logo-left">
            <div>
              <img src="<?php echo base_url('assets/img/logo2.png'); ?>">
            </div>
            <div>
              <img src="<?php echo base_url('assets/img/logo3.png'); ?>">
            </div>
          </div>
          <div class="form-header">
              <p>Republic of the Philippines</p>
              <p>Department of Education</p>
              <p>Region VIII, Eastern Visayas</p>
              <p class="school-name">EAST VISAYAN ADVENTIST ACADEMY OF LEYTE, INC.</p>
              <p>EVAA Heights, San Sotero, Javier, Leyte</p>
          </div>
          <div class="logo-right">
            <div>
              <img src="<?php echo base_url('assets/img/logo.png'); ?>">
            </div>
            <div>
              <img src="<?php echo base_url('assets/img/logo1.png'); ?>">
            </div>
          </div>
          <div class="form-content">
            <table>
              <tr>
                <td class="w20">ID:</td>
                <td colspan="3" class="form-content-underline"><?php echo $student->school_id; ?></td>
              <tr>
              <tr>
                <td class="w20">Name:</td>
                <td colspan="3" class="form-content-underline"><?php echo $student->firstname.' '.$student->lastname; ?></td>
              <tr>
              <tr>
                <td class="w20">Age:</td>
                <td class="w30 form-content-underline"></td>
                <td class="w20 lp10">Sex:</td>
                <td class="w30 form-content-underline"></td>
              <tr>
              <tr>
                <td class="w20">Grade:</td>
                <td class="w30 form-content-underline"></td>
                <td class="w20 lp10">Section:</td>
                <td class="w30 form-content-underline"></td>
              <tr>
              <tr>
                <td class="w20">School Year:</td>
                <td colspan="3" class="form-content-underline"><?php echo $school_year_data->school_year; ?></td>
              <tr>
            </table>
          </div>
        </div>

        <div class="transfer-div">
          <p>Dear Parent,</p>
          <p class="indented">This report card shows the ability and progress your child has made in the different learning areas as well as his/her core values.</p>
          <p class="indented">The school welcomes you should you desire to know more about your child's progress.</p>
        </div>

        <div class="form-signatures">
          <table>
            <tr>
              <td class="form-signature-td border-bottom-solid"></td>
              <td></td>
              <td class="form-signature-td border-bottom-solid"></td>
            </tr>
            <tr>
              <td class="form-signature-td text-center">Principal</td>
              <td></td>
              <td class="form-signature-td text-center">Teacher</td>
            </tr>
          </table>
        </div>

        <div class="certificate-transfer">
          <p class="text-center bold">Certificate of Transfer</p>
          <table>
            <tr>
              <td class="w25">Admitted to Grade:</td>
              <td class="form-content-underline"></td>
              <td class="w20 lp10">Section:</td>
              <td class="form-content-underline"></td>
            </tr>
          </table>
          <table>
            <tr>
              <td class="w40">Eligibility for Admission to Grade: </td>
              <td class="form-content-underline"></td>
            </tr>
          </table>
          <p>Approved:</p>
        </div>

        <div class="form-signatures">
          <table>
            <tr>
              <td class="form-signature-td border-bottom-solid"></td>
              <td></td>
              <td class="form-signature-td border-bottom-solid"></td>
            </tr>
            <tr>
              <td class="form-signature-td text-center">Principal</td>
              <td></td>
              <td class="form-signature-td text-center">Teacher</td>
            </tr>
          </table>
        </div>

        <div class="cancel-transfer">
          <p class="text-center bold">Cancellation of Eligibility to Transfer</p>
          <table>
              <tr>
                <td class="w20">Admitted in:</td>
                <td class="form-content-underline"></td>
              </tr>
              <tr>
                <td class="w20">Date:</td>
                <td class="form-content-underline"></td>
              </tr>
          </table>
        </div>

        <div class="principal-signature">
          <table>
            <tbody>
              <tr>
                <td></td>
                <td class="form-signature-td border-bottom-solid"></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td class="form-signature-td text-center">Principal</td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>

      </td>
    </tr>
  </table>

  <table class="form138-main-table2">
    <tr>
      <td class="main-td back-left">
        <p class="text-center bold">REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</p>
        <table class="table table-bordered">
          <tr>
            <td rowspan="2" class="middle-align text-center bold">Learning Areas</td>
            <td colspan="4" class="middle-align text-center bold">Quarter</td>
            <td rowspan="2" class="middle-align text-center bold">Final Grade</td>
            <td rowspan="2" class="middle-align text-center bold">Remarks</td>
          </tr>
          <tr>
            <td class="text-center bold">1</td>
            <td class="text-center bold">2</td>
            <td class="text-center bold">3</td>
            <td class="text-center bold">4</td>
          </tr>
          <?php 
            $num_subj = 0;
            $total_final = 0;
            foreach ($student_grades as $student_grade) {
              $total = 0;
              $num_subj++;
              ?>
              <tr>
                  <td><?php echo $student_grade->subject_name; ?></td>
                  <?php
                  foreach ($student_grade->grades as $grade) {
                      ?>
                      <td class="text-center"><?php $total += $grade; echo $grade; ?></td>
                      <?php
                  }
                  $final = $total/(count($student_grade->grades));
                  $total_final += $final;
                  ?>
                  <td class="text-center"><?php echo $final; ?></td>
                  <td class="text-center">
                  <?php
                    if ($final > 74) {
                      echo "Passed";
                    } else {
                      echo "Failed";
                    }
                  ?>
                  </td>
              </tr>
              <?php
            }
            $gen_average = round($total_final/$num_subj, 2);
          ?>
          <tr>
            <td></td>
            <td colspan="4" class="text-center bold">General Average</td>
            <td class="text-center"><?php echo $gen_average; ?></td>
            <td class="text-center">
              <?php
                if ($gen_average > 74) {
                  echo "Passed";
                } else {
                  echo "Failed";
                }
              ?>
            </td>
          </td>
        </table>
        <table class="grade-description">
          <tr>
            <td class="w40 bold">Descriptors</td>
            <td class="bold">Grading Scale</td>
            <td class="bold">Remarks</td>
          </tr>
          <tr>
            <td>Outstanding</td>
            <td>90-100</td>
            <td>Passed</td>
          </tr>
          <tr>
            <td>Very Satisfactory</td>
            <td>85-89</td>
            <td>Passed</td>
          </tr>
          <tr>
            <td>Satisfactory</td>
            <td>80-84</td>
            <td>Passed</td>
          </tr>
          <tr>
            <td>Fairly Satisfactory</td>
            <td>75-79</td>
            <td>Passed</td>
          </tr>
          <tr>
            <td>Did Not Meet Expectations</td>
            <td>Below 75</td>
            <td>Failed</td>
          </tr>
        </table>
      </td>
      <td class="main-td back-right">
        <p class="text-center bold">REPORT ON LEARNER'S OBSERVED VALUES</p>
        <table class="table table-bordered">
          <tr>
            <td rowspan="2" class="w25 middle-align text-center bold">Core Values</td>
            <td rowspan="2" class="middle-align text-center bold">Behavior Statements</td>
            <td colspan="4" class="middle-align text-center bold">Quarter</td>
          </tr>
          <tr>
            <td class="w8 middle-align text-center bold">1</td>
            <td class="w8 middle-align text-center bold">2</td>
            <td class="w8 middle-align text-center bold">3</td>
            <td class="w8 middle-align text-center bold">4</td>
          </tr>
          <tr>
            <td rowspan="2" class="middle-align">1. Maka-Diyos</td>
            <td>Expresses one's spiritual beliefs while respecting the spiritual beliefs of others</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Shows adherence to ethical principles by upholding truth</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td rowspan="2" class="middle-align">2. Makatao</td>
            <td>Is sensitive to individual, social, and cultural differences</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Demonstrates contributions towards solidarity</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="middle-align">3. Makakalikasan</td>
            <td>Cares for the environment and utilizes resources wisely, judiciously, and economically</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td rowspan="2" class="middle-align">4. Makabansa</td>
            <td>Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Demonstrates appropriate behavior in carrying out activities in the school, community, and country</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>

        <table class="rating-table">
          <tr>
            <td class="w20 text-center bold">Marking</td>
            <td class="bold">Non-numerical Rating</td>
          </tr>
          <tr>
            <td class="text-center">AO</td>
            <td>Always Observed</td>
          </tr>
          <tr>
            <td class="text-center">SO</td>
            <td>Sometimes Observed</td>
          </tr>
          <tr>
            <td class="text-center">RO</td>
            <td>Rarely Observed</td>
          </tr>
          <tr>
            <td class="text-center">NO</td>
            <td>Not Observed</td>
          </tr>
        </table>

      </td>
    </tr>
  </table>
  
</div>

</body>
</html>