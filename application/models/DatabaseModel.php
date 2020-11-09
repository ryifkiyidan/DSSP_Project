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
        if($table === 'direksi'){
            $this->db->select('direksi_id');
            $this->db->order_by('direksi_id', 'DESC');
            $this->db->limit(1);
            $data = $this->db->get($table)->row();
            if($data == NULL){
                return NULL;
            }else{
                return $data->direksi_id;
            }
        } 
        else if ($table === 'finance'){
            $this->db->select('finance_id');
            $this->db->order_by('finance_id', 'DESC');
            $this->db->limit(1);
            $data = $this->db->get($table)->row();
            if($data == NULL){
                return NULL;
            }else{
                return $data->finance_id;
            }
        }
    }

    public function getAllTable($id=NULL, $table){
        $this->db->where($table.'_id', $id);
        $data = $this->db->get($table)->row();
        return $data;
    }    

}
?>