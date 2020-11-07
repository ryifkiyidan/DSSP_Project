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
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $data = $this->db->get($table)->row();
        if($data == NULL){
            return NULL;
        }else{
            return $data->id;
        }
    }

    public function getKelas($id=NULL){
        $this->db->where('id', $id);
        $data = $this->db->get('kelas')->row();

        return $data;
    }

    public function getLesson($id=NULL){
        $this->db->where('id', $id);
        $data = $this->db->get('lesson')->row();

        return $data;
    }

    public function getMatPel($id=NULL){
        $this->db->where('id', $id);
        $data = $this->db->get('mata_pelajaran')->row();

        return $data;
    }

    public function getGuru($id=NULL){
        $this->db->where('nip', $id);
        $data = $this->db->get('guru')->row();

        return $data;
    }

    public function getSiswa($id=NULL){
        $this->db->where('nisn', $id);
        $data = $this->db->get('siswa')->row();

        return $data;
    }

    public function getSiswas($id=NULL){
        $this->db->where('kelasID', $id);
        $data = $this->db->get('siswa');

        return $data;
    }

    

}
?>