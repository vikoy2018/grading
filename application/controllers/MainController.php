<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends MY_Controller {
    public function __construct(){
        parent::__construct();

        if($this->session->userdata('user')){
            $user = $this->session->userdata('user');

            $account = $this->mydb_model->fetch('users', ['id'=>$user->user_id])[0];

            if ($account->usertype == 0) {
                redirect('student');
            }

            if ($account->usertype == 1) {
                redirect('parent');
            }
        }
    }

    public function index() {
        $data['title'] = 'Home';
        $data['active'] = 'home';
        $this->main('main/home', $data);
    }

    public function contact() {
        $data['title'] = 'Contact';
        $data['active'] = 'contact';
        $this->main('main/contact', $data);
    }

    public function submitContact(){
        $output = ['error'=>false];

        $subject = 'Message from your site';
        $email = $this->input->post('email');
        $message = '';
        $message .= '<p>From: <strong>'.$this->input->post('name').'</strong></p>';
        $message .= $this->input->post('message');

        if($this->sendemail($email, $subject, $message)) {
            $output['message'] = 'Message sent';
        } else {
            $output['error'] = true;
            $output['message'] = 'Unable to send message';
        }

        echo json_encode($output);
    }
 
}
