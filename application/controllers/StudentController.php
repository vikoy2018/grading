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

    public function logout() {
        $this->session->unset_userdata('user');
        redirect('/');
    }

}