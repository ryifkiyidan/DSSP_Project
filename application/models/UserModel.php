<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model {
    
    public function get($username){

        $this->db->where('username', $username);
        $data['user'] = $this->db->get('admin')->row();
        $data['role'] = 'admin';

        if(empty($data['user'])){

            $this->db->where('username', $username);
            $data['user'] = $this->db->get('guru')->row();
            $data['role'] = 'guru';

            if(empty($data['user'])){
                $this->db->where('username', $username);
                $data['user'] = $this->db->get('siswa')->row();
                $data['role'] = 'siswa';
            }

        }

        return $data;

    }

    public function getProfile($username, $role){

        if($role == 'admin'){
            $this->db->where('username', $username);
            $data['user'] = $this->db->get('admin')->row();
        }
        else if($role == 'guru'){
            $this->db->where('username', $username);
            $data['user'] = $this->db->get('guru')->row();
        }
        else if($role == 'siswa'){
            $this->db->where('username', $username);
            $data['user'] = $this->db->get('siswa')->row();
        }

        return $data;

    }

    public function update_data($where, $data, $table){
        $this->db->where($where);
		$this->db->update($table,$data);
    }
}
?>