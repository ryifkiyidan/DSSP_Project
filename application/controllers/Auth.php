<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MY_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('UserModel');
        $this->load->model('DatabaseModel');
    }
    public function index(){
        if($this->session->userdata('authenticated')) // Jika user sudah login (Session authenticated ditemukan)
            redirect('page/dashboard'); // Redirect ke page dashboard
            
        $data['curr_page'] = "login";
        $this->render_backend('login', $data); // Load view login.php
    }
    public function registrasi_ttd(){
        $data['curr_page'] = "registrasi_ttd";
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('registrasi_ttd', $data); // load view registrasi_ttd.php
    }
    public function login(){

        $this->load->library('encryption');
        $key = 'super-secret-key';
        
        $email = $this->input->post('email');       
        $password = md5($this->input->post('password'));
        $data     = $this->UserModel->get($email);
        
        if(empty($data['user'])){ // Jika hasilnya kosong / user tidak ditemukan
            $this->session->set_flashdata('message', 'email tidak ditemukan'); // Buat session flashdata
            redirect('auth'); // Redirect ke halaman login
        }else{
            if($password != $data['user']->password){ // Jika password yang diinput tidak sama dengan password yang didatabase
                $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
                redirect('auth'); // Redirect ke halaman login
            }else{ // Jika password yang diinput sama dengan password yang didatabase
                $signFlag = false;
                if($data['role'] === 'direksi'){
                    $signature = $this->DatabaseModel->getDatas('signature');
                    foreach($signature->result() as $sign){
                        if($sign->direksi_id === $data['user']->direksi_id){
                            $signFlag = true;
                        }
                    }
                }else{
                    $signFlag = true;
                }
                $session = array(
                    'authenticated' => true,                        // Buat session authenticated dengan value true
                    'user'         => $data['user'],               // Buat session user
                    'role'          => $data['role']                // Buat session role
                );
                $this->session->set_userdata($session); // Buat session sesuai $session
                // Jika belum registrasi ttd
                if(!$signFlag) redirect('auth/registrasi_ttd');
                else redirect('page/dashboard'); // Redirect ke halaman dashboard
                
            }
        }
    }
    public function logout(){
        $this->session->sess_destroy(); // Hapus semua session
        redirect('auth'); // Redirect ke halaman login
    }
}
?>