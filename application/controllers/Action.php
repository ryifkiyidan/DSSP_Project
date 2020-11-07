<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Action extends MY_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model('DatabaseModel');
    }

    public function _get_auto_generate_id(){
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

    public function _get_siswa_di_kelas($fieldValue, $primaryKeyValue){
        $siswas = $this->DatabaseModel->getSiswas($this->curr_kelasID);
        $header = '<select id="field-siswaNISN" name="siswaNISN" class="form-control" style="width: 300px;">';
        if(!isset($this->curr_state)) $body = '<option value="" selected disabled>Select Siswa</option>';
        else if ($this->curr_state == 'edit') $body = ""; 
        foreach($siswas->result() as $siswa){
            $temp = '<option value="'.$siswa->nisn.'"'
            .($siswa->nisn == $fieldValue? "selected" : "").'>'
            .$siswa->first_name.' '.$siswa->last_name.'</option>';
            $body = $body.$temp;
        }
        $footer = '</select>';
        return $header.$body.$footer;
    }

    public function _get_lesson_default(){
        return '<input id="field-lessonID" class="form-control" name="lessonID" type="text" value="'.$this->curr_lessonID.'" maxlength="6" readonly>';
    }

    public function _check_nilai($str){
        if($str >= 0.00 && $str <= 100.00) return true;
        else{
            $this->form_validation->set_message('_check_nilai',"The {field} field's value must be >= 0 and <= 100");
            return false;
        } 
    }

    public function _check_semester($str){
        if($str >= 1 && $str <= 6) return true;
        else{
            $this->form_validation->set_message('_check_semester',"The {field} field's value must be >= 1 and <= 6");
            return false;
        }
    }

    public function _callback_column_akhir($value, $row){
        $tugas=$row->tugas;
        $uts=$row->uts;
        $uas=$row->uas;
        $akhir= ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
        return $akhir;
    }

    public function nilai_siswa($lessonID=NULL){
        
        if($this->session->userdata('role') == 'guru') // Jika user yg login bukan guru
        {   
            $lesson = $this->DatabaseModel->getLesson($lessonID);
            if($this->session->userdata('nomor_induk') != $lesson->guruNIP) //Jika guru bukan pengajar di lesson tersebut
                show_404();
        }else show_404();
            
        $this->load->library('grocery_CRUD');
        
        $kelas = $this->DatabaseModel->getKelas($lesson->kelasID);
        $matpel = $this->DatabaseModel->getMatPel($lesson->matpelID);

        $this->curr_table = 'nilai';
        $this->curr_kelasID = $lesson->kelasID;
        $this->curr_lessonID = $lessonID;

        $crud = new grocery_CRUD();
        
        $crud->set_theme('tablestrap4');
        
        $crud->set_table('nilai')
             ->set_subject('Nilai Siswa');

        $crud->where('lessonID',$lessonID);

        $crud->set_relation('siswaNISN', 'siswa', '{first_name} {last_name}');

        $crud->callback_column('akhir',array($this,'_callback_column_akhir'));
        $crud->columns(array('siswaNISN', 'tugas', 'uts', 'uas', 'akhir', 'semester'));
        
        $crud->display_as('siswaNISN','Siswa');

        //Rules
        $crud->required_fields(array('id', 'semester', 'siswaNISN', 'lessonID'));
        $crud->set_rules('tugas','Nilai Tugas','numeric|callback__check_nilai');
        $crud->set_rules('uts','Nilai UTS','numeric|callback__check_nilai');
        $crud->set_rules('uas','Nilai UAS','numeric|callback__check_nilai');
        $crud->set_rules('semester','Semester','integer|callback__check_semester');

        $crud->callback_add_field('id', array($this,'_get_auto_generate_id'));
        $crud->callback_add_field('siswaNISN', array($this,'_get_siswa_di_kelas'));
        $crud->callback_add_field('lessonID', array($this,'_get_lesson_default'));

        $crud->callback_edit_field('siswaNISN', array($this,'_get_siswa_di_kelas'));
        if($crud->getState() == 'edit') {
            $this->curr_state = 'edit';
            $crud->field_type('id', 'hidden');
            $crud->field_type('lessonID', 'hidden');
       }
        
        $crud->unset_read();
        $crud->unset_clone();

        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $data['curr_page'] = "lesson";
        $data['sub_page'] = $matpel->name." ".$kelas->name;
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('crud_view', $data); // load view pengguna.php
    }
}
?>