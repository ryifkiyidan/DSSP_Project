<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model {
    
    public function get($email){

        $this->db->where('email', $email);
        $data['user'] = $this->db->get('direksi')->row();
        $data['role'] = 'direksi';

        if(empty($data['user'])){

            $this->db->where('email', $email);
            $data['user'] = $this->db->get('finance')->row();
            $data['role'] = 'finance';

        }

        return $data;

    }

    public function getUser($email, $role){

        if($role == 'direksi'){
            $this->db->where('email', $email);
            $data = $this->db->get('direksi')->row();
        }
        else if($role == 'finance'){
            $this->db->where('email', $email);
            $data = $this->db->get('finance')->row();
        }

        return $data;

    }

    public function updateData($where, $data, $table){
        $this->db->where($where);
		$this->db->update($table,$data);
    }
}
?>