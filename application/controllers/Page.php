<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends MY_Controller {

    public function home(){
        $data['curr_page'] = "home";
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('home', $data); // load view home.php
    }

    public function matpel(){
        if($this->session->userdata('role') != 'admin') // Jika user yg login bukan admin
            show_404(); // Redirect ke halaman 404 Not found

        $this->load->library('grocery_CRUD');

        $crud = new grocery_CRUD();
        $crud->set_theme('tablestrap4');

        $crud->set_table('mata_pelajaran')
                ->set_subject('Mata Pelajaran');
        $this->curr_table = "mata_pelajaran";
        
        //Rules
        $crud->required_fields(array('id', 'name'));
        $crud->set_rules('name', 'Name','trim|required');

        $crud->callback_add_field('id', array($this,'_get_auto_generate_id'));
        
        $crud->unset_read();
        $crud->unset_clone();

        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $data['curr_page'] = "matpel";
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('crud_view', $data);
        
    }

    public function kelas(){
        if($this->session->userdata('role') != 'admin') // Jika user yg login bukan admin
            show_404(); // Redirect ke halaman 404 Not found

        $this->load->library('grocery_CRUD');

        $crud = new grocery_CRUD();
        $crud->set_theme('tablestrap4');

        $crud->set_table('kelas')
             ->set_subject('Kelas');
        $this->curr_table = "kelas";

        //Rules
        $crud->required_fields(array('id', 'name'));
        $crud->set_rules('name', 'Name','trim|required');
        $crud->set_rules('tahun_ajaran', 'Name','trim');

        $crud->callback_add_field('id', array($this,'_get_auto_generate_id'));
        
        $crud->unset_read();
        $crud->unset_clone();

        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $data['curr_page'] = "kelas";
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('crud_view', $data);
    }

    public function lesson(){
        if($this->session->userdata('role') != 'admin' && $this->session->userdata('role') != 'guru')
            show_404();

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_theme('tablestrap4');
        
        if($this->session->userdata('role') == 'admin'){

            $crud->set_table('lesson')
                ->set_subject('Lesson')
                ->columns('id','matpelID','kelasID','guruNIP');
            
            $crud->set_relation('matpelID', 'mata_pelajaran', 'name')
                ->set_relation('kelasID', 'kelas', 'name')
                ->set_relation('guruNIP', 'guru', '{first_name} {last_name}');

            $crud->display_as('matpelID', 'Mata Pelajaran')
                ->display_as('kelasID','Kelas')
                ->display_as('guruNIP','Guru');
            
            $crud->unset_read();
            $crud->unset_clone();
                
            $this->curr_table = "lesson";
            
            //Rules
            $crud->required_fields(array('id', 'matpelID', 'kelasID', 'guruNIP'));

            $crud->callback_add_field('id', array($this,'_get_auto_generate_id'));
            
        }else if($this->session->userdata('role') == 'guru'){

            $crud->set_table('lesson')
            ->set_subject('Lesson')
            ->columns('matpelID','kelasID','guruNIP')
            ->where('guruNIP', $this->session->userdata('nomor_induk'));
            
            $crud->display_as('matpelID', 'Mata Pelajaran');
            $crud->display_as('kelasID', 'Kelas');
            $crud->display_as('guruNIP', 'Guru');
            
            $crud->unset_operations();

            $crud->add_action('Nilai Siswa', '','action/nilai_siswa', 'info-circle');
                    
            $crud->set_relation('guruNIP', 'guru', '{first_name} {last_name}',[
                        'guru.username = ' => $this->session->userdata('username')
                    ]);
            $crud->set_relation('matpelID', 'mata_pelajaran', 'name');
            $crud->set_relation('kelasID', 'kelas', 'name');
            
        }

        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $data['curr_page'] = "lesson";
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('crud_view', $data);
    }

    public function guru(){
        
        if($this->session->userdata('role') != 'admin') // Jika user yg login bukan admin
            show_404(); // Redirect ke halaman 404 Not found

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_theme('tablestrap4');
        
        $crud->set_table('guru')
             ->set_subject('Guru')
             ->columns('nip','first_name','last_name','gender','birth_date','username');
        
        $crud->change_field_type('password', 'password');

        $crud->callback_before_insert(array($this,'_encrypt_password_callback'));
        $crud->callback_before_update(array($this,'_encrypt_password_callback'));

        //Rules
        $crud->required_fields(array('nip', 'first_name','last_name','gender','birth_date','username','password'));
        $crud->unique_fields(array('nip','username'));
        $crud->set_rules('nip', 'NIP','integer|trim|required');
        $crud->set_rules('first_name', 'First Name','trim|required');
        $crud->set_rules('last_name', 'Last Name','trim|required');
        $crud->set_rules('username', 'Username','trim|required');
        $crud->set_rules('password', 'Password','trim|required');
        
        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $data['curr_page'] = "guru";
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('crud_view', $data);

    }

    public function siswa(){

        if($this->session->userdata('role') != 'admin') //Jika role bukan admin
            show_404(); // Redirect ke halaman 404 Not found

        $this->load->library('grocery_CRUD');

        $crud = new grocery_CRUD();
        $crud->set_theme('tablestrap4');

        $crud->set_table('siswa')
             ->set_subject('Siswa')
             ->set_relation('kelasID','kelas','name')
             ->display_as('kelasID', 'Kelas')
             ->columns('nisn','first_name','last_name','gender','birth_date','tahun_masuk','username','kelasID');
        
        $crud->change_field_type('password', 'password');

        $crud->callback_before_insert(array($this,'_encrypt_password_callback'));
        $crud->callback_before_update(array($this,'_encrypt_password_callback'));

        //Rules
        $crud->required_fields(array('nisn', 'first_name','last_name','gender','birth_date','username','password'));
        $crud->unique_fields(array('nisn','username'));
        $crud->set_rules('nisn', 'NISN','integer|trim|required');
        $crud->set_rules('first_name', 'First Name','trim|required');
        $crud->set_rules('last_name', 'Last Name','trim|required');
        $crud->set_rules('username', 'Username','trim|required');
        $crud->set_rules('password', 'Password','trim|required');

        $output = $crud->render();
        $data['crud'] = get_object_vars($output);
        $data['curr_page'] = "siswa";
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('crud_view', $data);
    }

    public function nilai(){
        if($this->session->userdata('role') != 'siswa') //Jika role bukan siswa
            show_404(); // Redirect ke halaman 404 Not found

        $nisn = $this->session->userdata('nomor_induk');
        
        $this->load->library('grocery_CRUD');

        $crud = new grocery_CRUD();
        $crud->set_theme('tablestrap4');

        $crud->set_table('nilai')
             ->set_subject('Nilai');
        
        $crud->where('siswaNISN', $nisn);

        $crud->columns(array('matpel','tugas', 'uts', 'uas', 'akhir', 'semester', 'guru'));

        $crud->callback_column('matpel',array($this,'_callback_column_matpel'));
        $crud->callback_column('akhir',array($this,'_callback_column_akhir'));
        $crud->callback_column('guru',array($this,'_callback_column_guru'));
        
        $crud->unset_read();
        $crud->unset_clone();
        $crud->unset_edit();
        $crud->unset_delete();
        $crud->unset_add();

        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $data['curr_page'] = "nilai";
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('crud_view', $data);
        
    }

    public function profile(){
        $this->load->model('UserModel');
        $this->load->model('DatabaseModel');

        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $data = $this->UserModel->getProfile($username, $role);
        if($role == 'siswa'){
            $data['kelas'] = $this->DatabaseModel->getKelas($data['user']->kelasID);
        }

        $data['curr_page'] = "profile";
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('profile', $data); // load view profile.php
    }

    public function form_profile(){
        
        $this->load->model('UserModel');
            
        $role = $this->session->userdata('role');
        $nomor_induk = $this->session->userdata('nomor_induk');

        $first_name = $this->input->post('iFName');
        $last_name = $this->input->post('iLName');
        $gender = $this->input->post('iGender');
        $birth_date = $this->input->post('iBDate');

        //Data
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'birth_date' => $birth_date
        );

        //Condition
        if($role == 'admin'){
            $where = array(
                'username' => $this->session->userdata('username')
            );
        }else if($role == 'guru'){
            $where = array(
                'nip' => $nomor_induk
            );
        }else if($role == 'siswa'){
            $where = array(
                'nisn' => $nomor_induk
            );
        }

        //Table
        $table = $role;
        
        $this->UserModel->update_data($where, $data, $table);

        $this->session->set_flashdata('message', 'Profile has changed successfully');

        redirect('page/profile');

    }

    public function form_account(){
        $this->load->model('UserModel');

        $this->load->library('encryption');
        $key = 'super-secret-key';

        $role = $this->session->userdata('role');
        $username = $this->session->userdata('username');
        $user     = $this->UserModel->get($username);
        $curr_password = md5($this->input->post('curr_password'));
        $new_password = md5($this->input->post('new_password'));

        if($curr_password != $user['user']->password){ // Jika password yang diinput tidak sama dengan password yang didatabase
            $this->session->set_flashdata('error', 'Current password is wrong'); // Buat session flashdata
            redirect('page/profile'); // Redirect ke halaman login
        }else{
            //Data
            $data = array(
                'password' => $new_password
            );

            //Condition
            $where = array(
                'username' => $username
            );

            //Table
            $table = $role;
            
            $this->UserModel->update_data($where, $data, $table);

            $this->session->set_flashdata('message', 'Password has changed successfully');

            redirect('page/profile');
        }

    }

    public function _get_auto_generate_id(){
        $this->load->model('DatabaseModel');
        $lastId = $this->DatabaseModel->getLastId($this->curr_table);
        if($lastId == NULL){
            switch($this->curr_table){
                case 'mata_pelajaran':
                    $lastId = 'MP0000';
                    break;
                case 'kelas':
                    $lastId = 'KS0000';
                    break;
                case 'lesson':
                    $lastId = 'LS0000';
                    break;
                case 'nilai':
                    $lastId = 'NL0000';
                    break;
            }
        }
        $newId = $this->DatabaseModel->getAutoId($lastId, 2, 4);
        return '<input id="field-id" class="form-control" name="id" type="text" value="'.$newId.'" maxlength="6" readonly>';
    }

    public function _callback_column_akhir($value, $row){
        $tugas=$row->tugas;
        $uts=$row->uts;
        $uas=$row->uas;
        $akhir= ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
        return $akhir;
    }

    public function _callback_column_matpel($value, $row){
        $this->load->model('DatabaseModel');
        $lesson = $this->DatabaseModel->getLesson($row->lessonID);
        $matpel = $this->DatabaseModel->getMatPel($lesson->matpelID);

        return $matpel->name;

    }

    public function _callback_column_guru($value, $row){
        $this->load->model('DatabaseModel');
        $lesson = $this->DatabaseModel->getLesson($row->lessonID);
        $guru = $this->DatabaseModel->getGuru($lesson->guruNIP);

        return $guru->first_name." ".$guru->last_name;

    }

    public function _encrypt_password_callback($post_array, $primary_key = null){
        $post_array['password'] = md5($post_array['password']);
        return $post_array;
    }

}
?>