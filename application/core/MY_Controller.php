<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // load
        $this->load->helper('url');
        $this->load->model('mydb_model');
        $this->load->library('session');

    }
    public function main($page = '', $data = '') {
        $this->load->view('main/header', $data);
        $this->load->view('main/navbar', $data);
        $this->load->view('main/banner', $data);
        $this->load->view($page, $data);
        $this->load->view('main/footer');
    }
    public function student($page = '', $data = '') {
        $this->load->view('main/student/header', $data);
        $this->load->view('main/student/navbar', $data);
        $this->load->view('main/student/banner', $data);
        $this->load->view($page, $data);
        $this->load->view('main/student/footer');
    }
    public function parent($page = '', $data = '') {
        $this->load->view('main/parent/header', $data);
        $this->load->view('main/parent/navbar', $data);
        $this->load->view('main/parent/banner', $data);
        $this->load->view($page, $data);
        $this->load->view('main/parent/footer');
    }
    public function admin($page = '', $data = '') {
        $this->load->view('admin/header', $data);
        $this->load->view('admin/navbar', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view($page, $data);
        $this->load->view('admin/footer');
    }
    public function teacher($page = '', $data = '') {
        $this->load->view('teacher/header', $data);
        $this->load->view('teacher/navbar', $data);
        $this->load->view('teacher/sidebar', $data);
        $this->load->view($page, $data);
        $this->load->view('teacher/footer');
    }
    public function mainlogin($page = '', $data = '') {
        $this->load->view('main/login-header', $data);
        $this->load->view($page, $data);
        $this->load->view('main/login-footer');
    }
    public function sendemail($emailto, $subject, $message, $attachment=[]){
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'eastvisayan2019@gmail.com', // change it to yours
            'smtp_pass' => 'evaa2019', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        ];
 
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($emailto);
        $this->email->to($config['smtp_user']);
        $this->email->subject($subject);
        $this->email->message($message);

        if($attachment){
            $this->email->attach($attachment['buffer'], 'attachment', $attachment['filename'], $attachment['type']);
        }
        
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
      
}
