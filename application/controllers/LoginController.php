<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends MY_Controller {
    public function __construct(){
        parent::__construct();

        // if($this->session->userdata('user')){
        //     $user = $this->session->userdata('user');
        //     if ($user->usertype == 0) {
        //         redirect('admin/home');
        //     }

        //     if ($user->usertype == 1) {
        //         redirect('staff/home');
        //     }
            
        // }

    }

    public function index() {
        echo "test";
        // $data['title'] = 'Admin Login';
        // $data['active'] = 'login';
        // $this->main('main/login', $data);
    }
    public function login(){
        $output = ['error'=>false];

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->mydb_model->fetch('users', ['username'=>$username]);

        if($user){
            $user = $user[0];
            // check password
            if(password_verify($password, $user->password)){
                $this->session->set_userdata('user', $user);
                $output['usertype'] = $user->usertype;
            } else {
                $output['error'] = true;
                $output['message'] = 'Incorrect Password';  
            }
        } else{
            $output['error'] = true;
            $output['message'] = 'Username not found';
        }
        echo json_encode($output);

    }

    public function test() {
        echo password_hash('student', PASSWORD_DEFAULT);
    }
}
