<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DatabaseModel extends CI_Model {

    // fungsi ini untuk menghasilkan autonumber bertipe string
    // terdapat tiga parameter yang dibutuhkan untuk menggunakan fungsi ini
    // $id_terakhir adalah kode terakhir dari database ex: KNS0015
    // $panjang_kode adalah panjang karakter string pada kode
    //               pada KNS0015 nilai $panjang_kode = 3
    // $panjang_angka adalah panjang karakter angka pada kode
    //               pada KNS0015 nilai $panjang_angka = 4

    public function getAutoId($id_terakhir, $panjang_kode, $panjang_angka) {
        // mengambil nilai kode ex: KNS0015 hasil KNS
        $kode = substr($id_terakhir, 0, $panjang_kode);
     
        // mengambil nilai angka
        // ex: KNS0015 hasilnya 0015
        $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
     
        // menambahkan nilai angka dengan 1
        // kemudian memberikan string 0 agar panjang string angka menjadi 4
        // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
        // sehingga menjadi 0006
        $angka_baru = str_repeat("0", $panjang_angka - strlen($angka+1)).($angka+1);
     
        // menggabungkan kode dengan nilang angka baru
        $id_baru = $kode.$angka_baru;
     
        return $id_baru;
    }

    public function getLastId($table){
        $this->db->select($table.'_id');
        $this->db->order_by($table.'_id', 'DESC');
        $this->db->limit(1);
        $data = $this->db->get($table);
        if($data == NULL){
            return NULL;
        }else{
            if($table === 'direksi') return $data->direksi_id;
            else if($table === 'finance') return $data->finance_id;
            else if($table === 'dokumen') return $data->dokumen_id;
        }
    }

    public function getNumRows($table){
        $data = $this->db->get($table);
        return $data->num_rows();
    }

    public function getDatas($table){
        $data = $this->db->get($table);
        return $data;
    }
    
    public function getData($table, $id){
        $this->db->where($table.'_id', $id);
        $data = $this->db->get($table);
        return $data;
    }
    
    public function insertData($table, $data){
		$this->db->insert($table,$data);
    }

    public function updateData($where, $table, $data){
        $this->db->where($where);
		$this->db->update($table,$data);
    }

    public function deleteData($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }

}
?>