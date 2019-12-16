<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends MY_Controller {
    public function __construct(){
        parent::__construct();

        if($this->session->userdata('user')){
            $user = $this->session->userdata('user');
            if ($user->usertype == 0) {
                redirect('student');
            }

            if ($user->usertype == 1) {
                redirect('parent');
            }
        }

    }

    public function index() {
        $data['title'] = 'Login';
        $data['active'] = 'login';
        $this->main('main/login', $data);
    }
    public function login(){
        $output = ['error'=>false];

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->mydb_model->fetch('users', ['username'=>$username]);

        if($user){
            $user = $user[0];
            // check if login is a student/parent
            if ($user->usertype == 0 || $user->usertype == 1) {
                // check password
                if(password_verify($password, $user->password)){
                    if ($user->usertype == 0) {
                        $output['user'] = 'student';
                        $student = $this->mydb_model->fetch('students', ['user_id'=>$user->id])[0];
                        $this->session->set_userdata('user', $student);
                    } else {
                        $output['user'] = 'parent';
                        $parent = $this->mydb_model->fetch('parents', ['user_id'=>$user->id])[0];
                        $this->session->set_userdata('user', $parent);
                    }
                } else {
                    $output['error'] = true;
                    $output['message'] = 'Incorrect Password';  
                }
            } else {
                $output['error'] = true;
                $output['message'] = 'Username not found'; 
            }
        } else{
            $output['error'] = true;
            $output['message'] = 'Username not found';
        }
        echo json_encode($output);

    }

}
