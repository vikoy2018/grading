<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLoginController extends MY_Controller {
	public function __construct() {
        parent::__construct();

        $this->user = $this->session->userdata('admin');

        if ($this->user) {
            redirect('/admin/dashboard');
        }
    }
    public function index() {
    	$data['title'] = 'Admin Login';
        $data['active'] = 'admin-login';
    	$this->main('main/adminlogin', $data);
    }
    public function login() {
    	$output = ['error'=>false];

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->mydb_model->fetch('users', ['username'=>$username]);

        if($user){
            $user = $user[0];
            // check if user is admin
            if ($user->usertype == 3) {
            	// check password
	            if(password_verify($password, $user->password)){
	            	$admin = $this->mydb_model->fetch('admins', ['user_id'=>$user->id]);
	            	if ($admin) {
	            		$admin = $admin[0];
	            		$this->session->set_userdata('admin', $admin);
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