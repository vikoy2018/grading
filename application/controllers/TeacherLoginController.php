<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherLoginController extends MY_Controller {
	public function __construct() {
        parent::__construct();

        $this->user = $this->session->userdata('teacher');

        if ($this->user) {
            redirect('/teacher/dashboard');
        }
    }
    public function index() {
    	$data['title'] = 'Teacher Login';
        $data['active'] = 'teacher-login';
    	$this->mainlogin('main/teacherlogin', $data);
    }
    public function login() {
    	$output = ['error'=>false];

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->mydb_model->fetch('users', ['username'=>$username]);

        if($user){
            $user = $user[0];
            // check if user is admin
            if ($user->usertype == 2) {
            	// check password
	            if(password_verify($password, $user->password)){
	            	$teacher = $this->mydb_model->fetch('teachers', ['user_id'=>$user->id]);
	            	if ($teacher) {
	            		$teacher = $teacher[0];
	            		$this->session->set_userdata('teacher', $teacher);
	            	} else {
	            		$output['error'] = true;
	                	$output['message'] = 'Unable to fetch details';
	            	}
	            } else {
	                $output['error'] = true;
	                $output['message'] = 'Incorrect Password';  
	            }
            } else {
            	$output['error'] = true;
            	$output['message'] = 'Invalid access';
            }
        } else{
            
            $output['error'] = true;
            $output['message'] = 'Username not found';
        }
        echo json_encode($output);
    }
}