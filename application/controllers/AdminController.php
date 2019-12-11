<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends MY_Controller {
    public function __construct(){
        parent::__construct();

        $this->user = $this->session->userdata('admin');

        if (!$this->user) {
            redirect('/admin');
        }

    }

    public function logout(){
        $this->session->unset_userdata('admin');
        redirect('admin');
    }

    public function index() {
        $data['title'] = 'Admin Dashboard';
        $data['active'] = 'admin-dashboard';
        $data['user'] = $this->user;
        // $data['attendance_today'] = $this->mydb_model->fetch('attendance', ['date'=>date('Y-m-d')], [], '', true);
        // $data['members'] = $this->mydb_model->fetch('employees', [], [], '', true);
        // $data['events'] = $this->mydb_model->fetch('events', [], [], '', true);
        // $data['total_attendance'] = $this->mydb_model->fetch('attendance', [], [], '', true);
        $this->admin('admin/dashboard', $data);
    }

    public function admins() {
        $data['title'] = 'Admin Admins';
        $data['active'] = 'admin-admins';
        $data['user'] = $this->user;
        $this->admin('admin/admin', $data);
    }

    public function data_admin() {
        $columns = [
            'users.username', 'users.password', 'firstname', 'lastname'
        ];
        $where = ['admins.is_deleted'=>0];
        $select = 'admins.id as admin_id, admins.firstname, admins.lastname, admins.photo, users.username, users.password';
        $join = [
            'users'=>'users.id=admins.user_id',
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'users.username', 'firstname', 'lastname'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('admins',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('admins',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('admins',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('admins',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function addAdmin() {
        $output = ['error'=>false];

        $user = [
            'username' => $this->input->post('username'),
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'usertype' => 3,
            'is_deleted' => 0,
        ];

        $user_id = $this->mydb_model->insert('users', $user);

        if ($user_id) {
            $admin = [
                'user_id' => $user_id,
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'created_on' => date('Y-m-d'),
                'is_deleted' => 0
            ];

            if (!empty($_FILES['file']['name'])) {
                $newFilename = time() . "_" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
                $admin['photo'] = $newFilename;
            } else {
                $admin['photo'] = '';
            }

            $added = $this->mydb_model->insert('admins', $admin);

            if ($added) {
                $output['message'] = 'Admin added';
            } else {
                $output['error'] = true;
                $output['message'] = 'Can\'t add admin';
            }
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add admin';
        }

        echo json_encode($output);
    }

    public function getAdminById() {
        $id = $this->input->post('id');
       
        $data = $this->mydb_model->fetch('admins', ['admins.id'=>$id], ['users'=>'users.id=admins.user_id'], 'LEFT', false, 'admins.id AS admin_id, user_id, firstname, lastname, username');

        echo json_encode($data);

    }

    public function editAdmin() {
        $output = ['error'=>false];

        $adminid = $this->input->post('adminid');
        $userid = $this->input->post('userid');

        $user = [
            'username' => $this->input->post('username'),
        ];

        $updated_user = $this->mydb_model->update('users', $user, ['id'=>$userid]);

        if ($updated_user) {
            $admin = [
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
            ];

            if (!empty($_FILES['file']['name'])) {
                $newFilename = time() . "_" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
                $admin['photo'] = $newFilename;
            }          

            $updated_admin = $this->mydb_model->update('admins', $admin, ['id'=>$adminid]);

            if ($updated_admin) {
                $output['message'] = 'Admin updated';
            } else {
                $output['error'] = true;
                $output['message'] = 'Can\'t update admin';
            }            
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update admin';
        }

        echo json_encode($output);
    }

    public function deleteAdmin() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $admin = $this->mydb_model->fetch('admins', ['id'=>$id]);
        $admin = $admin[0];

        // update both user and admin
        $this->mydb_model->update('admins', ['is_deleted'=>1], ['id'=>$id]);
        $this->mydb_model->update('users', ['is_deleted'=>1], ['id'=>$admin->user_id]);

        $output['message'] = 'Admin deleted';
    
        echo json_encode($output);
    }

    public function teachers() {
        $data['title'] = 'Admin Teachers';
        $data['active'] = 'admin-teachers';
        $data['user'] = $this->user;
        $this->admin('admin/teacher', $data);
    }

    public function data_teacher() {
        $columns = [
            'users.username', 'users.password', 'firstname', 'lastname'
        ];
        $where = ['teachers.is_deleted'=>0];
        $select = 'teachers.id as teacher_id, teachers.firstname, teachers.lastname, teachers.photo, users.username, users.password';
        $join = [
            'users'=>'users.id=teachers.user_id',
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'users.username', 'firstname', 'lastname'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('teachers',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('teachers',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('teachers',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('teachers',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function addTeacher() {
        $output = ['error'=>false];

        $user = [
            'username' => $this->input->post('username'),
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'usertype' => 2,
            'is_deleted' => 0,
        ];

        $user_id = $this->mydb_model->insert('users', $user);

        if ($user_id) {
            $teacher = [
                'user_id' => $user_id,
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'created_on' => date('Y-m-d'),
                'is_deleted' => 0
            ];

            if (!empty($_FILES['file']['name'])) {
                $newFilename = time() . "_" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
                $teacher['photo'] = $newFilename;
            } else {
                $teacher['photo'] = '';
            }

            $added = $this->mydb_model->insert('teachers', $teacher);

            if ($added) {
                $output['message'] = 'Teacher added';
            } else {
                $output['error'] = true;
                $output['message'] = 'Can\'t add teacher';
            }
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add teacher';
        }

        echo json_encode($output);
    }

    public function getTeacherById() {
        $id = $this->input->post('id');
       
        $data = $this->mydb_model->fetch('teachers', ['teachers.id'=>$id], ['users'=>'users.id=teachers.user_id'], 'LEFT', false, 'teachers.id AS teacher_id, user_id, firstname, lastname, username');

        echo json_encode($data);
    }

    public function editTeacher() {
        $output = ['error'=>false];

        $teacherid = $this->input->post('teacherid');
        $userid = $this->input->post('userid');

        $user = [
            'username' => $this->input->post('username'),
        ];

        $updated_user = $this->mydb_model->update('users', $user, ['id'=>$userid]);

        if ($updated_user) {
            $teacher = [
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
            ];

            if (!empty($_FILES['file']['name'])) {
                $newFilename = time() . "_" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
                $teacher['photo'] = $newFilename;
            }          

            $updated_teacher = $this->mydb_model->update('teachers', $teacher, ['id'=>$teacherid]);

            if ($updated_teacher) {
                $output['message'] = 'Teacher updated';
            } else {
                $output['error'] = true;
                $output['message'] = 'Can\'t update teacher';
            }            
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update teacher';
        }

        echo json_encode($output);
    }

    public function deleteTeacher() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $teacher = $this->mydb_model->fetch('teachers', ['id'=>$id]);
        $teacher = $teacher[0];

        // update both user and teacher
        $this->mydb_model->update('teachers', ['is_deleted'=>1], ['id'=>$id]);
        $this->mydb_model->update('users', ['is_deleted'=>1], ['id'=>$teacher->user_id]);

        $output['message'] = 'Teacher deleted';
    
        echo json_encode($output);
    }

    public function students() {
        $data['title'] = 'Admin Students';
        $data['active'] = 'admin-students';
        $data['user'] = $this->user;
        $this->admin('admin/student', $data);
    }

    public function data_student() {
        $columns = [
            'users.username', 'users.password', 'students.firstname', 'students.lastname', 'students.photo', 'parents.firstname'
        ];
        $where = ['students.is_deleted'=>0];
        $select = 'students.id AS student_id, students.firstname AS student_firstname, students.lastname AS student_lastname, students.photo, users.username, users.password, parents.firstname AS parent_firstname, parents.lastname AS parent_lastname';
        $join = [
            'users'=>'users.id=students.user_id',
            'student_parents'=>'student_parents.student_id=students.id',
            'parents' => 'parents.id=student_parents.parent_id'
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'users.username', 'firstname', 'lastname'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('students',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('students',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('students',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('students',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function addStudent() {
        $output = ['error'=>false];

        $user = [
            'username' => $this->input->post('username'),
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'usertype' => 2,
            'is_deleted' => 0,
        ];

        $user_id = $this->mydb_model->insert('users', $user);

        if ($user_id) {
            $student = [
                'user_id' => $user_id,
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'created_on' => date('Y-m-d'),
                'is_deleted' => 0
            ];

            if (!empty($_FILES['file']['name'])) {
                $newFilename = time() . "_" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
                $student['photo'] = $newFilename;
            } else {
                $student['photo'] = '';
            }

            $added = $this->mydb_model->insert('students', $student);

            if ($added) {
                $output['message'] = 'Student added';
            } else {
                $output['error'] = true;
                $output['message'] = 'Can\'t add student';
            }
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add student';
        }

        echo json_encode($output);
    }

    public function getStudentById() {
        $id = $this->input->post('id');
       
        $data = $this->mydb_model->fetch('students', ['students.id'=>$id], ['users'=>'users.id=students.user_id'], 'LEFT', false, 'students.id AS student_id, user_id, firstname, lastname, username');

        echo json_encode($data);
    }

    public function editStudent() {
        $output = ['error'=>false];

        $studentid = $this->input->post('studentid');
        $userid = $this->input->post('userid');

        $user = [
            'username' => $this->input->post('username'),
        ];

        $updated_user = $this->mydb_model->update('users', $user, ['id'=>$userid]);

        if ($updated_user) {
            $student = [
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
            ];

            if (!empty($_FILES['file']['name'])) {
                $newFilename = time() . "_" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
                $student['photo'] = $newFilename;
            }          

            $updated_student = $this->mydb_model->update('students', $student, ['id'=>$studentid]);

            if ($updated_student) {
                $output['message'] = 'Student updated';
            } else {
                $output['error'] = true;
                $output['message'] = 'Can\'t update student';
            }            
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update student';
        }

        echo json_encode($output);
    }

    public function deleteStudent() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $student = $this->mydb_model->fetch('students', ['id'=>$id]);
        $student = $student[0];

        // update both user and student
        $this->mydb_model->update('students', ['is_deleted'=>1], ['id'=>$id]);
        $this->mydb_model->update('users', ['is_deleted'=>1], ['id'=>$student->user_id]);

        $output['message'] = 'Student deleted';
    
        echo json_encode($output);
    }

    public function parents() {
        $data['title'] = 'Admin Parents';
        $data['active'] = 'admin-parents';
        $data['user'] = $this->user;
        $this->admin('admin/parent', $data);
    }

    public function data_parent() {
        $columns = [
            'users.username', 'users.password', 'firstname', 'lastname'
        ];
        $where = ['parents.is_deleted'=>0];
        $select = 'parents.id as parent_id, parents.firstname, parents.lastname, parents.photo, users.username, users.password';
        $join = [
            'users'=>'users.id=parents.user_id',
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'users.username', 'firstname', 'lastname'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('parents',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('parents',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('parents',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('parents',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function addParent() {
        $output = ['error'=>false];

        $user = [
            'username' => $this->input->post('username'),
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'usertype' => 2,
            'is_deleted' => 0,
        ];

        $user_id = $this->mydb_model->insert('users', $user);

        if ($user_id) {
            $parent = [
                'user_id' => $user_id,
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'created_on' => date('Y-m-d'),
                'is_deleted' => 0
            ];

            if (!empty($_FILES['file']['name'])) {
                $newFilename = time() . "_" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
                $parent['photo'] = $newFilename;
            } else {
                $parent['photo'] = '';
            }

            $added = $this->mydb_model->insert('parents', $parent);

            if ($added) {
                $output['message'] = 'Parent added';
            } else {
                $output['error'] = true;
                $output['message'] = 'Can\'t add parent';
            }
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add parent';
        }

        echo json_encode($output);
    }

    public function getParentById() {
        $id = $this->input->post('id');
       
        $data = $this->mydb_model->fetch('parents', ['parents.id'=>$id], ['users'=>'users.id=parents.user_id'], 'LEFT', false, 'parents.id AS parent_id, user_id, firstname, lastname, username');

        echo json_encode($data);
    }

    public function editParent() {
        $output = ['error'=>false];

        $parentid = $this->input->post('parentid');
        $userid = $this->input->post('userid');

        $user = [
            'username' => $this->input->post('username'),
        ];

        $updated_user = $this->mydb_model->update('users', $user, ['id'=>$userid]);

        if ($updated_user) {
            $parent = [
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
            ];

            if (!empty($_FILES['file']['name'])) {
                $newFilename = time() . "_" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
                $parent['photo'] = $newFilename;
            }          

            $updated_parent = $this->mydb_model->update('parents', $parent, ['id'=>$parentid]);

            if ($updated_parent) {
                $output['message'] = 'Parent updated';
            } else {
                $output['error'] = true;
                $output['message'] = 'Can\'t update parent';
            }            
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update parent';
        }

        echo json_encode($output);
    }

    public function deleteParent() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $parent = $this->mydb_model->fetch('parents', ['id'=>$id]);
        $parent = $parent[0];

        // update both user and parent
        $this->mydb_model->update('parents', ['is_deleted'=>1], ['id'=>$id]);
        $this->mydb_model->update('users', ['is_deleted'=>1], ['id'=>$parent ->user_id]);

        $output['message'] = 'Parent deleted';
    
        echo json_encode($output);
    }

    public function subjects() {
        $data['title'] = 'Admin Subjects';
        $data['active'] = 'admin-subjects';
        $data['user'] = $this->user;
        $this->admin('admin/subject', $data);
    }

    public function data_subject() {
        $columns = [
            'subject_name'
        ];
        $where = ['is_deleted'=>0];
        $select = '*';
        $join = [];
        $join_type = '';
        $search_columns = [
            'subject_name'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('subjects',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('subjects',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('subjects',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('subjects',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function addSubject() {
        $output = ['error'=>false];

        $subject = [
            'subject_name' => $this->input->post('subject_name'),
            'is_deleted' => 0,
        ];

        $added = $this->mydb_model->insert('subjects', $subject);

        if ($added) {
            $output['message'] = 'Subject added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add subject';
        }
       
        echo json_encode($output);
    }

    public function getRowById() {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
       
        $data = $this->mydb_model->fetch($table, ['id'=>$id]);

        echo json_encode($data);
    }

    public function editSubject() {
        $output = ['error'=>false];

        $subjectid = $this->input->post('subjectid');

        $subject = [
            'subject_name' => $this->input->post('edit_subject_name'),
        ];

        $updated = $this->mydb_model->update('subjects', $subject, ['id'=>$subjectid]);

        if ($updated) {
            $output['message'] = 'Subject updated';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update subject';
        }            
        
        echo json_encode($output);
    }

    public function deleteSubject() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $this->mydb_model->update('subjects', ['is_deleted'=>1], ['id'=>$id]);

        $output['message'] = 'Subject deleted';
    
        echo json_encode($output);
    }

    public function gradings() {
        $data['title'] = 'Admin Gradings';
        $data['active'] = 'admin-gradings';
        $data['user'] = $this->user;
        $this->admin('admin/grading', $data);
    }

    public function data_grade() {
        $columns = [
            'period'
        ];
        $where = ['is_deleted'=>0];
        $select = '*';
        $join = [];
        $join_type = '';
        $search_columns = [
            'period'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('gradings',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('gradings',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('gradings',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('gradings',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function addPeriod() {
        $output = ['error'=>false];

        $grading = [
            'period' => $this->input->post('period'),
            'is_deleted' => 0,
        ];

        $added = $this->mydb_model->insert('gradings', $grading);

        if ($added) {
            $output['message'] = 'Period added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add period';
        }
       
        echo json_encode($output);
    }

    public function editPeriod() {
        $output = ['error'=>false];

        $periodid = $this->input->post('periodid');

        $grading = [
            'period' => $this->input->post('edit_period'),
        ];

        $updated = $this->mydb_model->update('gradings', $grading, ['id'=>$periodid]);

        if ($updated) {
            $output['message'] = 'Period updated';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update period';
        }            
        
        echo json_encode($output);
    }

    public function deletePeriod() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $this->mydb_model->update('gradings', ['is_deleted'=>1], ['id'=>$id]);

        $output['message'] = 'Period deleted';
    
        echo json_encode($output);
    }

    public function schoolYear() {
        $data['title'] = 'Admin School Years';
        $data['active'] = 'admin-years';
        $data['user'] = $this->user;
        $this->admin('admin/school_year', $data);
    }

    public function data_year() {
        $columns = [
            'school_year'
        ];
        $where = ['is_deleted'=>0];
        $select = '*';
        $join = [];
        $join_type = '';
        $search_columns = [
            'school_year'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('school_years',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('school_years',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('school_years',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('school_years',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function addYear() {
        $output = ['error'=>false];

        $year = [
            'school_year' => $this->input->post('school_year'),
            'is_deleted' => 0,
        ];

        $added = $this->mydb_model->insert('school_years', $year);

        if ($added) {
            $output['message'] = 'School year added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add school year';
        }
       
        echo json_encode($output);
    }

    public function editYear() {
        $output = ['error'=>false];

        $yearid = $this->input->post('yearid');

        $year = [
            'school_year' => $this->input->post('edit_school_year'),
        ];

        $updated = $this->mydb_model->update('school_years', $year, ['id'=>$yearid]);

        if ($updated) {
            $output['message'] = 'School year updated';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update school year';
        }            
        
        echo json_encode($output);
    }

    public function deleteYear() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $this->mydb_model->update('school_years', ['is_deleted'=>1], ['id'=>$id]);

        $output['message'] = 'School year deleted';
    
        echo json_encode($output);
    }

    public function subjectTeachers() {
        $data['title'] = 'Admin Subject Teachers';
        $data['active'] = 'admin-subject-teachers';
        $data['user'] = $this->user;
        $this->admin('admin/subject_teacher', $data);
    }

    public function data_subjectTeacher() {
        $columns = [
            'subjects.subject_name', 'teachers.firstname', 'school_years.school_year'
        ];
        $where = ['subject_teachers.is_deleted'=>0];
        $select = 'subject_teachers.id as subject_teacher_id, subject_name, firstname, lastname, school_year';
        $join = [
            'subjects' => 'subjects.id=subject_teachers.subject_id',
            'teachers' => 'teachers.id=subject_teachers.teacher_id',
            'school_years' => 'school_years.id=subject_teachers.school_year_id'
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'subjects.subject_name', 'teachers.firstname', 'school_years.school_year'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('subject_teachers',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('subject_teachers',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('subject_teachers',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('subject_teachers',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function getTeachers() {
        $data = $this->mydb_model->fetch('teachers', ['is_deleted'=>0]);

        echo json_encode($data);
    }

    public function getSubjects() {
        $data = $this->mydb_model->fetch('subjects', ['is_deleted'=>0]);

        echo json_encode($data);
    }

    public function getSchoolYears() {
         $data = $this->mydb_model->fetch('school_years', ['is_deleted'=>0]);

        echo json_encode($data);
    }

    public function addSubjectTeacher() {
        $output = ['error'=>false];

        $subject_teacher = [
            'subject_id' => $this->input->post('subject_id'),
            'teacher_id' => $this->input->post('teacher_id'),
            'school_year_id' => $this->input->post('school_year_id'),
            'is_deleted' => 0,
        ];

        $added = $this->mydb_model->insert('subject_teachers', $subject_teacher);

        if ($added) {
            $output['message'] = 'Subject teacher added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add subject teacher';
        }
       
        echo json_encode($output);
    }

    public function getSubjectTeacherById() {
        $id = $this->input->post('id');

        $data = $this->mydb_model->fetch('subject_teachers', ['subject_teachers.id'=>$id], ['subjects'=>'subjects.id=subject_teachers.subject_id', 'teachers'=>'teachers.id=subject_teachers.teacher_id', 'school_years'=>'school_years.id=subject_teachers.school_year_id'], 'LEFT');

        echo json_encode($data);
    }

    public function editSubjectTeacher() {
        $output = ['error'=>false];

        $subjectteacherid = $this->input->post('subjectteacherid');

        $subjectteacher = [
            'subject_id' => $this->input->post('edit_subject_id'),
            'teacher_id' => $this->input->post('edit_teacher_id'),
            'school_year_id' => $this->input->post('edit_school_year_id')
        ];

        $updated = $this->mydb_model->update('subject_teachers', $subjectteacher, ['id'=>$subjectteacherid]);

        if ($updated) {
            $output['message'] = 'Subject teacher updated';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t update subject teacher';
        }            
        
        echo json_encode($output);
    }

    public function deleteSubjectTeacher() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $this->mydb_model->update('subject_teachers', ['is_deleted'=>1], ['id'=>$id]);

        $output['message'] = 'Subject teacher deleted';
    
        echo json_encode($output); 
    }

    public function subjectStudents($subject_teacher_id) {
        $data['title'] = 'Admin Subject Students';
        $data['active'] = 'admin-subject-students';
        $data['user'] = $this->user;
        $data['subject'] = $this->mydb_model->fetch('subject_teachers', ['subject_teachers.id'=>$subject_teacher_id], ['subjects'=>'subjects.id=subject_teachers.subject_id', 'teachers'=>'teachers.id=subject_teachers.teacher_id', 'school_years'=>'school_years.id=subject_teachers.school_year_id'], 'LEFT')[0];
        $data['subject_teacher_id'] = $subject_teacher_id;
        $this->admin('admin/subject_student', $data);
    }

    public function data_subjectStudent() {
        $columns = [
            'students.lastname', 'students.firstname'
        ];
        $where = ['subject_teacher_id'=>$this->input->post('subject_teacher_id')];
        $select = 'subject_students.id AS subject_student_id, firstname, lastname';
        $join = [
            'students' => 'students.id=subject_students.student_id',
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'students.firstname', 'students.lastname'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('subject_students',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('subject_students',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('subject_students',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('subject_students',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function getStudents() {
        $data = $this->mydb_model->fetch('students', ['is_deleted'=>0]);

        echo json_encode($data);
    }

    public function addSubjectStudent() {
        $subject_teacher_id = $this->input->post('subject_teacher_id');
        $student_id = $this->input->post('student_id');

        $output = ['error'=>false];

        $subject_student = [
            'student_id' => $this->input->post('student_id'),
            'subject_teacher_id' => $this->input->post('subject_teacher_id'),
        ];

        $added = $this->mydb_model->insert('subject_students', $subject_student);

        if ($added) {
            $output['message'] = 'Subject student added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add subject student';
        }
       
        echo json_encode($output);
    }

    public function deleteSubjectStudent() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $this->mydb_model->delete('subject_students', ['id'=>$id]);

        $output['message'] = 'Subject student deleted';
    
        echo json_encode($output); 
    }

    public function parentStudents($parent_id) {
        $data['title'] = 'Admin Parents Students';
        $data['active'] = 'admin-parent-students';
        $data['user'] = $this->user;
        $data['parent'] = $this->mydb_model->fetch('parents', ['id'=>$parent_id])[0];
        $data['parent_id'] = $parent_id;
        $this->admin('admin/parent_student', $data);
    }

    public function data_parentStudent() {
         $columns = [
            'students.firstname', 'students.lastname'
        ];
        $where = ['parent_id'=>$this->input->post('parent_id')];
        $select = 'student_parents.id AS parent_student_id, firstname, lastname';
        $join = [
            'students' => 'students.id=student_parents.student_id',
        ];
        $join_type = 'LEFT';
        $search_columns = [
            'students.firstname', 'students.lastname'
        ];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->mydb_model->fetch('student_parents',$where,[],'',true);
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $data = $this->mydb_model->get_datatable('student_parents',$limit,$start,$order,$dir,$where,$join,$join_type,$select);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $data =  $this->mydb_model->get_datatable('student_parents',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns);

            $totalFiltered = $this->mydb_model->get_datatable('student_parents',$limit,$start,$order,$dir,$where,$join,$join_type,$select,$search,$search_columns,true);
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
            
        echo json_encode($json_data);
    }

    public function addParentStudent() {
        $parent_id = $this->input->post('parent_id');
        $student_id = $this->input->post('student_id');

        $output = ['error'=>false];

        $parent_student = [
            'student_id' => $this->input->post('student_id'),
            'parent_id' => $this->input->post('parent_id'),
        ];

        $added = $this->mydb_model->insert('student_parents', $parent_student);

        if ($added) {
            $output['message'] = 'Student added';
        } else {
            $output['error'] = true;
            $output['message'] = 'Can\'t add student';
        }
       
        echo json_encode($output);
    }

    public function deleteParentStudent() {
        $output = ['error'=>false];

        $id = $this->input->post('id');
        
        $this->mydb_model->delete('student_parents', ['id'=>$id]);

        $output['message'] = 'Student deleted';
    
        echo json_encode($output); 
    }

    public function profile() {
        $data['title'] = 'Admin Profile';
        $data['active'] = 'admin-profile';
        $data['user'] = $this->user;
        $user = $this->mydb_model->fetch('users', ['id'=>$this->user->id])[0];
        $data['user']->username = $user->username;
        $data['user']->password = $user->password;
        $this->admin('admin/profile', $data);
    }

    public function checkPassword() {
        $output = ['error'=>false];

        $password = $this->input->post('prof_password');

        $user = $this->mydb_model->fetch('users', ['id'=>$this->user->user_id])[0];

        if (password_verify($password, $user->password)) {
            $output['message'] = 'Password verified';
        } else {
            $output['error'] = true;
            $output['message'] = 'Incorrect Password';
        }
    
        echo json_encode($output);
    }

    public function updateProfile() {
        $output = ['error'=>false];

        $user_id = $this->input->post('user_id');
        $admin_id = $this->input->post('admin_id');

        $auser = $this->mydb_model->fetch('users', ['id'=>$user_id])[0];

        if ($this->input->post('password') == $auser->password) {
            $password = $this->input->post('password');
        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $user = [
            'username' => $this->input->post('username'),
            'password' => $password
        ];

        $this->mydb_model->update('users', $user, ['id'=>$user_id]);

        $admin = [
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
        ];

        if (!empty($_FILES['file']['name'])) {
            $newFilename = time() . "_" . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], './uploads/' . $newFilename);
            $admin['photo'] = $newFilename;
        }

        $this->mydb_model->update('admins', $admin, ['id'=>$admin_id]);

        $this->session->unset_userdata('admin');

        echo json_encode($output);
    }
    
}
