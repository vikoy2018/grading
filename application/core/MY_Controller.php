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
      
}
