<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends MY_Controller {
    public function __construct(){
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Home';
        $data['active'] = 'home';
        $this->main('main/home', $data);
    }
    
}
