<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentController extends MY_Controller {
    public function __construct(){
        parent::__construct();

        $this->user = $this->session->userdata('user');

        if (!$this->user) {
            redirect('/');
        }

    }

    public function index() {
        $data['title'] = 'Home';
        $data['active'] = 'home';
        $data['user'] = $this->user;
        $this->student('main/home', $data);
    }

    public function grades($school_year_id = '') {
        $data['title'] = 'Grades';
        $data['active'] = 'student-grades';
        $data['user'] = $this->user;
        $gradings = $this->mydb_model->fetch('gradings', ['is_deleted'=>0], [], '', false, '*', 'period', 'ASC');
        $data['gradings'] = $gradings;
        $school_years = $this->mydb_model->fetch('subject_students', ['subject_students.student_id'=>$this->user->id], ['subject_teachers'=>'subject_teachers.id=subject_students.subject_teacher_id', 'school_years'=>'school_years.id=subject_teachers.school_year_id'], 'LEFT', false, 'school_year_id, school_year', 'school_years.school_year', 'DESC', '', 'school_year_id');
        if ($school_year_id) {
            $year_id = $school_year_id;
            $data['school_year'] = $this->mydb_model->fetch('school_years', ['id'=>$year_id], [], '', false, 'school_years.id AS school_year_id', 'school_year');
        } else {
            $year_id = $school_years[0]->school_year_id;
            $data['school_year'] = $school_years[0];
        }
        $subject_students = $this->mydb_model->fetch('subject_students', ['subject_students.student_id'=>$this->user->id, 'subject_teachers.school_year_id'=> $year_id], ['subject_teachers'=>'subject_teachers.id=subject_students.subject_teacher_id', 'school_years'=>'school_years.id=subject_teachers.school_year_id', 'subjects'=>'subjects.id=subject_teachers.subject_id'], 'LEFT', false, 'subject_students.id AS subject_student_id, subject_name, school_year');

        $data['student_grades'] = [];

        foreach ($subject_students as $subject_student) {
            $student_grades = $subject_student;

            $student_grades->grades = [];

            foreach ($gradings as $grading) {
                $student_grade_score = $this->mydb_model->fetch('student_grades', ['subject_student_id'=>$subject_student->subject_student_id, 'grading_id'=>$grading->id]);
                if ($student_grade_score) {
                    $grade = $student_grade_score[0]->grade;
                } else {
                    $grade = 0;
                }
                $student_grades->grades[] = $grade;
            }

            $data['student_grades'][] = $student_grades;
        }

        $data['school_years'] =  $school_years;

        $this->student('main/student/grades', $data);
    }

    public function logout() {
        $this->session->unset_userdata('user');
        redirect('/');
    }

}