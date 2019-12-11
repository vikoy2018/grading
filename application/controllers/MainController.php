<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends MY_Controller {
    public function __construct(){
        parent::__construct();
    }

    public function index() {
        // $data['title'] = 'Attendance';
        // $data['consolidation_place'] = $this->mydb_model->fetch('consolidation_place');
        // $data['active'] = 'home';
        // $this->main('main/attendance', $data);
        echo "Under Construction. Stay tuned.. :)";
    }
    public function login(){
        $output = ['error'=>false];

        $member_id = $this->input->post('member');
        $consolidation_place_id = $this->input->post('consolidation_place');

        $is_member = $this->mydb_model->fetch('employees', ['employee_id'=>$member_id]);

        if ($is_member) {
            $member = $is_member[0];
            $logged_in = $this->mydb_model->fetch('attendance', ['date'=>date('Y-m-d'), 'employee_id'=>$member->id]);
            if ($logged_in) {
                $output['error'] = true;
                $output['message'] = 'You have consolidate for today';
            } else {
                $consolidate = [
                    'employee_id' => $member->id,
                    'consolidation_place_id' => $consolidation_place_id,
                    'date' => date('Y-m-d')
                ];
                $this->mydb_model->insert('attendance', $consolidate);
                $output['message'] =  'Consolidate: '.ucfirst($member->firstname).' '.ucfirst($member->lastname);
            }
        } else {
            $output['error'] = true;
            $output['message'] = 'Member not found';
        }
        
        echo json_encode($output);
    }

    public function test() {
        echo password_hash('admin', PASSWORD_DEFAULT);
    }
}
