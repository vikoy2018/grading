<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends MY_Controller {
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
        $data['title'] = 'Home';
        $data['active'] = 'home';
        $this->main('main/home', $data);
    }
    
}
