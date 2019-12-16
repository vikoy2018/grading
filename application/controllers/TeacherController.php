<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherController extends MY_Controller {
    public function __construct(){
        parent::__construct();

        $this->user = $this->session->userdata('teacher');

        if (!$this->user) {
            redirect('/teacher');
        }

    }

    public function logout(){
        $this->session->unset_userdata('teacher');
        redirect('teacher');
    }

    public function index(){
        $data['title'] = 'Teacher Dashboard';
        $data['active'] = 'teacher-dashboard';
        $data['user'] = $this->user;
        $data['users'] = $this->mydb_model->fetch('users', [], [], '', true);
        $data['subjects'] = $this->mydb_model->fetch('subjects', [], [], '', true);
        $data['teachers'] = $this->mydb_model->fetch('teachers', [], [], '', true);
        $data['students'] = $this->mydb_model->fetch('students', [], [], '', true);
        $this->teacher('teacher/dashboard', $data);
    }

    public function profile() {
        $data['title'] = 'Teacher Profile';
        $data['active'] = 'teacher-profile';
        $data['user'] = $this->user;
        $user = $this->mydb_model->fetch('users', ['id'=>$this->user->user_id])[0];
        $data['user']->username = $user->username;
        $data['user']->password = $user->password;
        $this->teacher('teacher/profile', $data);
    }

     public function checkPassword() {
        $output = ['error'=>false];

        $password = $this->input->post('prof_password');

        $user = $this->mydb_model->fetch('users', ['id'=>$this->user->user_id])[0];

        if (password_verify($password, $user->password)) {
            $output['message'] = 'Password verified';
        } else {
            $output['error'] = true;
            $output['message'] = 'Incorrect Password';
        }
    
        echo json_encode($output);
    }

    public function updateProfile() {
        $output = ['error'=>false];

        $user_id = $this->input->post('user_id');
        $teacher_id = $this->input->post('teacher_id');

        $auser = $this->mydb_model->fetch('users', ['id'=>$user_id])[0];

        if ($this->input->post('password') == $auser->password) {
            $password = $this->input->post('password');
        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $user = [
            'username' => $this->input->post('username'),
            'password' => $password
        ];

        $this->mydb_model->update('users', $user, ['id'=>$user_id]);

        $teacher = [
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
        ];

        if (!empty($_FILES['file']['name'])) {
            $newFilename = time() . "_" . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
            $teacher['photo'] = $newFilename;
        }

        $this->mydb_model->update('teachers', $teacher, ['id'=>$teacher_id]);

        $this->session->unset_userdata('teacher');

        echo json_encode($output);
    }

    public function subjects() {
        $data['title'] = 'Teacher Subjects';
        $data['active'] = 'teacher-subjects';
        $data['user'] = $this->user;
        $this->teacher('teacher/subject', $data);
    }

    public function data_subject() {
        $teacher_id = $this->input->post('teacher_id');
        $columns = [
            'subject_name', 'school_year'
        ];
        $where = ['subject_teachers.is_deleted'=>0, 'subject_teachers.teacher_id'=>$teacher_id];
        $select = 'subject_teachers.id AS subject_teacher_id, subject_name, school_year';
        $join = [
            'subjects'=>'subjects.id=subject_teachers.subject_id',
            'school_years'=>'school_years.id=subject_teachers.school_year_id'
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'subject_name', 'school_year'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('subject_teachers',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('subject_teachers',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('subject_teachers',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('subject_teachers',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function subjectCriterias($subject_teacher_id) {
        $data['title'] = 'Teacher Subject Criteria';
        $data['active'] = 'teacher-criteria';
        $data['user'] = $this->user;
        $data['subject'] = $this->mydb_model->fetch('subject_teachers', ['subject_teachers.id'=>$subject_teacher_id], ['subjects'=>'subjects.id=subject_teachers.subject_id', 'school_years'=>'school_years.id=subject_teachers.school_year_id'], 'LEFT')[0];
        $data['subject_teacher_id'] = $subject_teacher_id;
        $this->teacher('teacher/criteria', $data);
    }

    public function data_criteria() {
        $subject_teacher_id = $this->input->post('subject_teacher_id');
        $columns = [
            'criteria', 'percentage'
        ];
        $where = ['subject_criterias.is_deleted'=>0, 'subject_criterias.subject_teacher_id'=>$subject_teacher_id];
        $select = '*';
        $join = [];
        $join_type = '';
        $search_columns = [
            'criteria', 'percentage'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('subject_criterias',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('subject_criterias',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('subject_criterias',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('subject_criterias',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function addCriteria() {
        $output = ['error'=>false];

        $criteria = [
            'subject_teacher_id' => $this->input->post('subject_teacher_id'),
            'criteria' => $this->input->post('criteria'),
            'percentage' => $this->input->post('percentage'),
            'is_deleted' => 0,
        ];

        $added = $this->mydb_model->insert('subject_criterias', $criteria);

        if ($added) {
            $output['message'] = 'Criteria added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add criteria';
        }
       
        echo json_encode($output);
    }

    public function getRowById() {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
       
        $data = $this->mydb_model->fetch($table, ['id'=>$id]);

        echo json_encode($data);
    }

    public function editCriteria() {
        $output = ['error'=>false];

        $criteria_id = $this->input->post('criteria_id');

        $criteria = [
            'criteria' => $this->input->post('edit_criteria'),
            'percentage' => $this->input->post('edit_percentage'),
        ];

        $updated = $this->mydb_model->update('subject_criterias', $criteria, ['id'=>$criteria_id]);

        if ($updated) {
            $output['message'] = 'Criteria updated';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update criteria';
        }            
        
        echo json_encode($output);
    }

    public function deleteCriteria() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $this->mydb_model->update('subject_criterias', ['is_deleted'=>1], ['id'=>$id]);

        $output['message'] = 'Criteria deleted';
    
        echo json_encode($output);
    }

    public function criteriaScores($subject_criteria_id) {
        $data['title'] = 'Teacher Criteria Scores';
        $data['active'] = 'teacher-criteria-score';
        $data['user'] = $this->user;
        $data['score'] = $this->mydb_model->fetch('subject_criterias', ['subject_criterias.id'=>$subject_criteria_id], ['subject_teachers'=>'subject_teachers.id=subject_criterias.subject_teacher_id', 'subjects'=>'subjects.id=subject_teachers.subject_id', 'school_years'=>'school_years.id=subject_teachers.school_year_id'], 'LEFT')[0];
        $data['subject_criteria_id'] = $subject_criteria_id;
        $this->teacher('teacher/score', $data);
    }

    public function data_score() {
        $subject_criteria_id = $this->input->post('subject_criteria_id');
        $columns = [
            'period', 'total_score'
        ];
        $where = ['criteria_scores.is_deleted'=>0, 'criteria_scores.subject_criteria_id'=>$subject_criteria_id];
        $select = 'criteria_scores.id AS score_id, period, total_score';
        $join = ['gradings'=>'gradings.id=criteria_scores.grading_id'];
        $join_type = 'LEFT';
        $search_columns = [
            'period', 'total_score'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('criteria_scores',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('criteria_scores',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('criteria_scores',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('criteria_scores',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function getGradings() {
        $data = $this->mydb_model->fetch('gradings', ['is_deleted'=>0], [], '', false, '*', 'period', 'ASC');

        echo json_encode($data);
    }

    public function addScore() {
        $output = ['error'=>false];

        $score = [
            'subject_criteria_id' => $this->input->post('subject_criteria_id'),
            'grading_id' => $this->input->post('grading_id'),
            'total_score' => $this->input->post('total_score'),
            'is_deleted' => 0,
        ];

        $added = $this->mydb_model->insert('criteria_scores', $score);

        if ($added) {
            $output['message'] = 'Score added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add score';
        }
       
        echo json_encode($output);
    }

    public function getScoreById() {
        $id = $this->input->post('id');

        $data = $this->mydb_model->fetch('criteria_scores', ['criteria_scores.id'=>$id], ['gradings'=>'gradings.id=criteria_scores.grading_id'], 'LEFT', false, 'criteria_scores.id AS score_id, grading_id, period, total_score');

        echo json_encode($data);

    }

    public function editScore() {
        $output = ['error'=>false];

        $score_id = $this->input->post('score_id');

        $score = [
            'grading_id' => $this->input->post('edit_grading_id'),
            'total_score' => $this->input->post('edit_total_score'),
        ];

        $updated = $this->mydb_model->update('criteria_scores', $score, ['id'=>$score_id]);

        if ($updated) {
            $output['message'] = 'Score updated';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update score';
        }            
        
        echo json_encode($output);
    }

    public function deleteScore() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $this->mydb_model->update('criteria_scores', ['is_deleted'=>1], ['id'=>$id]);

        $output['message'] = 'Score deleted';
    
        echo json_encode($output);
    }

    public function subjectStudents($subject_teacher_id) {
        $data['title'] = 'Teacher Subject Students';
        $data['active'] = 'teacher-subject-students';
        $data['user'] = $this->user;
        $data['subject'] = $this->mydb_model->fetch('subject_teachers', ['subject_teachers.id'=>$subject_teacher_id], ['subjects'=>'subjects.id=subject_teachers.subject_id', 'school_years'=>'school_years.id=subject_teachers.school_year_id'], 'LEFT')[0];
        $data['subject_teacher_id'] = $subject_teacher_id;
        $data['gradings'] = $this->mydb_model->fetch('gradings', ['is_deleted'=>0], [], '', false, '*', 'period', 'ASC');
        $this->teacher('teacher/student', $data);
    }

    public function data_subject_student() {
        $subject_teacher_id = $this->input->post('subject_teacher_id');
        $columns = [
            'lastname',
        ];
        $where = ['subject_students.subject_teacher_id'=>$subject_teacher_id];
        $select = 'subject_students.id AS subject_student_id, firstname, lastname, GROUP_CONCAT(student_grades.grade ORDER BY gradings.period ASC) AS grades';
        $join = [
            'students'=>'students.id=subject_students.student_id', 
            'student_grades'=>'student_grades.subject_student_id=subject_students.id',
            'gradings'=>'gradings.id=student_grades.grading_id' 
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'firstname', 'lastname'
        ];
        $group_by = 'subject_students.id';

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('subject_students',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('subject_students',$limit,$start,$order,$dir,$where,$join,$join_type,$select,'','',false,$group_by);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('subject_students',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,false,$group_by);

            $totalFiltered = $this->mydb_model->get_datatable('subject_students',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true,$group_by);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function studentSheet($subject_student_id, $grading_id) {
        $data['title'] = 'Teacher Student Sheet';
        $data['active'] = 'teacher-sheet';
        $data['user'] = $this->user;
        $data['grading'] = $this->mydb_model->fetch('gradings', ['id'=>$grading_id])[0];
        $data['subject_student_id'] = $subject_student_id;

        $data['criterias'] = [];

        $subject_student = $this->mydb_model->fetch('subject_students', ['id'=>$subject_student_id])[0];
        $criterias = $this->mydb_model->fetch('subject_criterias', ['subject_teacher_id'=>$subject_student->subject_teacher_id], [], '', false, '*', 'percentage', 'ASC');

        $data['student'] = $this->mydb_model->fetch('students', ['id'=>$subject_student->student_id])[0];
        $data['subject'] = $this->mydb_model->fetch('subject_teachers', ['subject_teachers.id'=>$subject_student->subject_teacher_id], ['subjects'=>'subjects.id=subject_teachers.subject_id', 'school_years'=>'school_years.id=subject_teachers.school_year_id'], 'LEFT')[0];

        $num = 0;
        foreach ($criterias as $criteria) {
            $data['criterias'][$num] = $criteria;

            $scores = $this->mydb_model->fetch('criteria_scores', ['subject_criteria_id'=>$criteria->id, 'grading_id'=>$grading_id]);
            $score_num = 0;
            foreach ($scores as $score) {
                $data['criterias'][$num]->scores[$score_num] = $score;

                $student_score = $this->mydb_model->fetch('student_criteria_scores', ['criteria_score_id'=>$score->id, 'student_id'=>$subject_student->student_id]);

                $data['criterias'][$num]->scores[$score_num]->student_score = $student_score;

                $score_num++;
            }

            $num++;
        }

        $data['submitted'] = false;

        $grade_exist = $this->mydb_model->fetch('student_grades', ['subject_student_id'=>$subject_student_id, 'grading_id'=>$grading_id]);
        
        if ($grade_exist) {
            $data['submitted'] = true;
        }

        $this->load->view('teacher/sheet', $data);
    }

    public function SaveScores() {
        $output = ['error'=>false];

        $student_id = $this->input->post('student_id');
        $num = 0;
        foreach ($this->input->post('criteria_score_id') as $criteria_score_id) {
            $score = $this->input->post('score')[$num];
            // check if score exist, edit otherwise add
            $exist = $this->mydb_model->fetch('student_criteria_scores', ['criteria_score_id'=>$criteria_score_id, 'student_id'=>$student_id]);
            if ($exist) {
                $this->mydb_model->update('student_criteria_scores', ['score'=>$score], ['criteria_score_id'=>$criteria_score_id, 'student_id'=>$student_id]);
            } else {
                $this->mydb_model->insert('student_criteria_scores', ['criteria_score_id'=>$criteria_score_id, 'student_id'=>$student_id, 'score'=>$score]);
            }
            $num++;
        }

        $output['message'] = 'Scores updated';
    
        echo json_encode($output);
    }

    public function submitGrade() {
        $output = ['error'=>false];

        $student_id = $this->input->post('student_id');
        $grading_id = $this->input->post('grading_id');
        $subject_student_id = $this->input->post('subject_student_id');

        $grade = 0;

        $num = 0;
        foreach ($this->input->post('criteria_score_id') as $criteria_score_id) {
            $score = $this->input->post('score')[$num];
            // check if score exist, edit otherwise add
            $exist = $this->mydb_model->fetch('student_criteria_scores', ['criteria_score_id'=>$criteria_score_id, 'student_id'=>$student_id]);
            if ($exist) {
                $this->mydb_model->update('student_criteria_scores', ['score'=>$score], ['criteria_score_id'=>$criteria_score_id, 'student_id'=>$student_id]);
            } else {
                $this->mydb_model->insert('student_criteria_scores', ['criteria_score_id'=>$criteria_score_id, 'student_id'=>$student_id, 'score'=>$score]);
            }
            $num++;
        }

        // calculate grade
        $subject_student = $this->mydb_model->fetch('subject_students', ['id'=>$subject_student_id])[0];
        $subject_teacher_id = $subject_student->subject_teacher_id;

        // criterias
        $subject_criterias = $this->mydb_model->fetch('subject_criterias', ['subject_teacher_id'=>$subject_teacher_id]);

        // criteria score
        foreach ($subject_criterias as $subject_criteria) {
            $percentage = $subject_criteria->percentage;
            $criteria_scores = $this->mydb_model->fetch('criteria_scores', ['subject_criteria_id'=>$subject_criteria->id]);
            $total_criteria_score = 0;
            $total_student_score = 0;
            foreach ($criteria_scores as $criteria_score) {
                $total_criteria_score += $criteria_score->total_score;
                $student_score = $this->mydb_model->fetch('student_criteria_scores', ['criteria_score_id'=>$criteria_score->id])[0];
                $total_student_score += $student_score->score;
            }
            $criteria_grade = ($total_student_score/$total_criteria_score)*$percentage;
            $grade += $criteria_grade;

        }

        // add to student grade
        $student_grade = [
            'subject_student_id' => $subject_student_id,
            'grading_id' => $grading_id,
            'grade' => $grade
        ];

        $grade_added = $this->mydb_model->insert('student_grades', $student_grade);

        if ($grade_added) {
            $output['message'] = 'Student grade added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add grade';
        } 
    
        echo json_encode($output);
    }

    public function previewGrade() {
        $output = ['error'=>false];

        $student_id = $this->input->post('student_id');
        $grading_id = $this->input->post('grading_id');
        $subject_student_id = $this->input->post('subject_student_id');

        $grade = 0;

        $num = 0;
        foreach ($this->input->post('criteria_score_id') as $criteria_score_id) {
            $score = $this->input->post('score')[$num];
            // check if score exist, edit otherwise add
            $exist = $this->mydb_model->fetch('student_criteria_scores', ['criteria_score_id'=>$criteria_score_id, 'student_id'=>$student_id]);
            if ($exist) {
                $this->mydb_model->update('student_criteria_scores', ['score'=>$score], ['criteria_score_id'=>$criteria_score_id, 'student_id'=>$student_id]);
            } else {
                $this->mydb_model->insert('student_criteria_scores', ['criteria_score_id'=>$criteria_score_id, 'student_id'=>$student_id, 'score'=>$score]);
            }
            $num++;
        }

        // calculate grade
        $subject_student = $this->mydb_model->fetch('subject_students', ['id'=>$subject_student_id])[0];
        $subject_teacher_id = $subject_student->subject_teacher_id;

        // criterias
        $subject_criterias = $this->mydb_model->fetch('subject_criterias', ['subject_teacher_id'=>$subject_teacher_id]);

        // criteria score
        foreach ($subject_criterias as $subject_criteria) {
            $percentage = $subject_criteria->percentage;
            $criteria_scores = $this->mydb_model->fetch('criteria_scores', ['subject_criteria_id'=>$subject_criteria->id]);
            $total_criteria_score = 0;
            $total_student_score = 0;
            foreach ($criteria_scores as $criteria_score) {
                $total_criteria_score += $criteria_score->total_score;
                $student_score = $this->mydb_model->fetch('student_criteria_scores', ['criteria_score_id'=>$criteria_score->id])[0];
                $total_student_score += $student_score->score;
            }
            $criteria_grade = ($total_student_score/$total_criteria_score)*$percentage;
            $grade += $criteria_grade;

        }

        $output['grade'] = $grade;
    
        echo json_encode($output);
    }

}