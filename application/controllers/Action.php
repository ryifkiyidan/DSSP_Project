<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require $_SERVER['DOCUMENT_ROOT'] . '/DSSP_Project' . '/vendor/autoload.php';
use \ConvertApi\ConvertApi;
use Ilovepdf\Ilovepdf;
class Action extends MY_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('DatabaseModel');
        $this->load->model('UserModel');
    }

    public function registrasi_ttd(){
        if (!empty($_FILES) && isset($_FILES['fileToUpload'])) {
            $allowedExts = array(
                "png"
            );
            $uploadOk = false;
            switch ($_FILES['fileToUpload']["error"]) {
                case UPLOAD_ERR_OK:
                    $file_id = md5($this->session->userdata('user')->direksi_id);
                    $file_name = basename($_FILES['fileToUpload']['name']);
                    $file_ext = end(explode(".", $_FILES["fileToUpload"]["name"]));
                    $file_loc = './assets/uploads/signatures/';
                    $file_loc = $file_loc . $file_id . '.' . $file_ext;
                    $file_loc2 = '/assets/uploads/signatures/' . $file_id . '.' . $file_ext;
                    if (in_array($file_ext, $allowedExts)){
                        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $file_loc)) {
                            $msg = "Signature has been registered successfully";
                            $uploadOk = true;
                            
                            // insert to database
                            // Data
                            date_default_timezone_set("Asia/Jakarta");
                            $user = $this->UserModel->getUser($this->session->userdata('email'), 'finance');
                            $data = array(
                                'signature_id' => $file_id,
                                'direksi_id' => $this->session->userdata('user')->direksi_id,
                                'location' => $file_loc2,
                            );

                            // Table
                            $table = 'signature';

                            $this->DatabaseModel->insertData($table, $data);
                            
                        }
                        else {
                            $msg = "Sorry, there was a problem uploading your file.";
                        }
                    }
                    else{
                        $msg = "File type must PNG";
                    }
                    break;
            }
            $data['msg'] = $msg;
            $data['status'] = $uploadOk;
            $this->session->set_flashdata('data', $data);
            if($uploadOk) redirect('page/dashboard');
            else redirect('auth/registrasi_ttd');
        }
    }

    public function file_upload(){
        if($this->session->userdata('role') != 'finance') show_404();
        $dokumen_id = '';
        $direksi_id = $this->input->post('direksi');
        $signature_pos = $this->input->post('signaturePos');
        $signature_page = $this->input->post('signaturePage');
        if (!empty($_FILES) && isset($_FILES['fileToUpload']) && $direksi_id !== NULL) {
            $allowedExts = array(
                "pdf"
            );
            $uploadOk = false;
            switch ($_FILES['fileToUpload']["error"]) {
                case UPLOAD_ERR_OK:
                    $file_id = md5('dok'.($this->DatabaseModel->getNumRows('dokumen')+1));
                    $dokumen_id = $file_id;
                    $file_name = basename($_FILES['fileToUpload']['name']);
                    $file_ext = end(explode(".", $_FILES["fileToUpload"]["name"]));
                    $file_loc = './assets/uploads/files/';
                    $file_loc = $file_loc . $file_id . '.' . $file_ext;
                    $file_loc2 = '/assets/uploads/files/' . $file_id . '.' . $file_ext;
                    if (in_array($file_ext, $allowedExts)){
                        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $file_loc)) {
                            $msg = "The file " . $file_name . " has been uploaded successfully";
                            $uploadOk = true;
                            
                            // generate thumbnail and get path location image
                            $thumbnail_loc = $this->generateThumbnail($file_loc, $file_id);
                            
                            // insert to database
                            // Data
                            date_default_timezone_set("Asia/Jakarta");
                            $data = array(
                                'dokumen_id' => $file_id,
                                'finance_id' => $this->session->userdata('user')->finance_id,
                                'direksi_id' => $direksi_id,
                                'signature_id' => NULL,
                                'signature_pos' => $signature_pos,
                                'signature_page' => $signature_page,
                                'name' => substr($file_name, 0, strrpos($file_name, '.')),
                                'location' => $file_loc2,
                                'thumbnail' => $thumbnail_loc,
                                'upload_date' => strtotime("now"),
                                'due_date' => strtotime("+1 week"),
                                'status' => "pending",
                            );

                            // Table
                            $table = 'dokumen';

                            $this->DatabaseModel->insertData($table, $data);
                            
                        }
                        else {
                            $msg = "Sorry, there was a problem uploading your file.";
                        }
                    }
                    else{
                        $msg = "File type must PDF";
                    }
                    break;
            }
            $data['msg'] = $msg;
            $data['status'] = $uploadOk;
            // Send Notification Email
            if($uploadOk){
                $dokumen = $this->DatabaseModel->getData('dokumen', $dokumen_id)->row();
                $direksi = $this->DatabaseModel->getData('direksi', $dokumen->direksi_id)->row();
                $finance = $this->DatabaseModel->getData('finance', $dokumen->finance_id)->row();
                if(isset($dokumen) && isset($direksi) && isset($finance)){
                    if($direksi->gender === 'male') $gender = 'Bapak';
                    else $gender = 'Ibu';

                    $to = $direksi->email;
                    $subject = 'Notification: Dokumen Pending by '.ucwords($finance->first_name.' '.$finance->last_name).' (Finance)';
                    $message = '<p>Kepada '.$gender.' <strong>'.ucwords($direksi->first_name.' '.$direksi->last_name).'</strong></p>
                    <p>Dengan email ini diberitahukan bahwa:</p>
                    <p style="padding-left: 40px;">Nama Dokumen: <strong>'.$dokumen->name.'</strong><br />Status: <strong>'.ucwords($dokumen->status).'</strong><br />Upload Date: <strong>'.date('d M Y H:i:s', $dokumen->upload_date).'</strong><br />Due Date: <strong>'.date('d M Y H:i:s', $dokumen->due_date).'</strong><br /><br /></p>
                    <p>Telah dikirim, mohon untuk segera diproses sebelum tanggal yang telah tercantum diatas.</p>';
                    $attach = NULL;
                    $email = array(
                        'to' => $to,
                        'subject' => $subject,
                        'message' => $message,
                        'attach' => $attach,
                    );
                    $this->send_notificationEmail($email);
                }else{
                    echo "Notifikasi email gagal dikirim";
                }
            }
            $this->session->set_flashdata('data', $data);
            redirect('page/dashboard');
        }else{
            $data['msg'] = 'Something went wrong';
            if($direksi_id === NULL) $data['msg'] = 'Direksi field cannot be empty';
            $data['status'] = false;
            $this->session->set_flashdata('data', $data);
            redirect('page/dashboard');
        }
    }

    public function delete(){

    }

    public function approve(){
        if($this->session->userdata('role') != 'direksi') show_404();
        $docId = $this->input->get('docid');
        $dokumen = $this->DatabaseModel->getData('dokumen',$docId);
        if($dokumen->num_rows() < 1) show_404();
        foreach($dokumen->result() as $dok){
            if($dok->dokumen_id === $docId){
                $dokumen = $dok;
                break;
            }
        }
        $signature_id = $this->addSignature($dokumen);
        //Data
        $data = array(
            'signature_id' => $signature_id,
            'status' => 'approved'
        );

        //Condition
        $where = array(
            'dokumen_id' => $docId
        );

        //Table
        $table = 'dokumen';
        $this->DatabaseModel->updateData($where, $table, $data);
        $data['msg'] = 'Document Approved';
        $data['status'] = true;
        $this->session->set_flashdata('data', $data);
        redirect('page/dashboard'); // Redirect ke halaman dashboard
    }

    public function reject(){
        if($this->session->userdata('role') != 'direksi') show_404();
        $docId = $this->input->get('docid');
        $dokumen = $this->DatabaseModel->getData('dokumen',$docId);
        if($dokumen->num_rows() < 1) show_404();
        //Data
        $data = array(
            'status' => 'rejected'
        );

        //Condition
        $where = array(
            'dokumen_id' => $docId
        );

        //Table
        $table = 'dokumen';
        $this->DatabaseModel->updateData($where, $table, $data);

        $data['msg'] = 'Document Rejected';
        $data['status'] = false;
        $this->session->set_flashdata('data', $data);
        redirect('page/dashboard'); // Redirect ke halaman dashboard
    }

    public function generateThumbnail($file_loc, $file_id){
        // generate thumbnail
        // pastikan sudah menjalankan command "composer require convertapi/convertapi-php"
        // tanpa tanda kutip
        ConvertApi::setApiSecret('oZ5quO9fgxMI8b4s');
        $result = ConvertApi::convert('thumbnail', [
                'File' => $file_loc,
                'FileName' => $file_id,
                'PageRange' => '1',
            ], 'pdf'
        ); 
        $result->saveFiles('./assets/uploads/thumbnails');
        $thumbnail_loc = '/assets/uploads/thumbnails/' . $file_id . '.jpg';
        return $thumbnail_loc;
    }

    public function addSignature($dokumen){
        $signature = $this->DatabaseModel->getData('signature', md5($this->session->userdata('user')->direksi_id));
        if($signature->num_rows() < 1) show_404();
        foreach($signature->result() as $sign){
            if($sign->signature_id === md5($this->session->userdata('user')->direksi_id)){
                $signature = $sign;
                break;
            }
        }
        // Create a new task
        $project_id = 'project_public_28ee5d7c5e37cbc2f53fdbed954d36c9_FvWHLc3bf23eedb62e726f8987fa0f4840764';
        $project_key = 'secret_key_bc34ba5b399de41180ad0d5d9403baa2_I9L5j2d8789a22e0395179ecb8373b6ac6b10';
        $ilovepdf = new Ilovepdf($project_id,$project_key);
        $myTaskWatermark = $ilovepdf->newTask('watermark');
        // Add files to task for upload
        $file1 = $myTaskWatermark->addFile('.' . $dokumen->location);
        // Add Image to task
        $image = $myTaskWatermark->addFile('.' . $signature->location);
        // set mode to image
        $myTaskWatermark->setMode("image");
        // set watermark image
        $myTaskWatermark->setImage($image->server_filename);
        // set watermark page
        $myTaskWatermark->setPages($dokumen->signature_page);
        switch ($dokumen->signature_pos) {
            case 'top-left':
                $myTaskWatermark->setVerticalPosition("top");
                $myTaskWatermark->setHorizontalPosition("left");
                break;
            case 'top-right':
                $myTaskWatermark->setVerticalPosition("top");
                $myTaskWatermark->setHorizontalPosition("right");
                break;
            case 'bottom-left':
                $myTaskWatermark->setVerticalPosition("bottom");
                $myTaskWatermark->setHorizontalPosition("left");
                break;
            case 'bottom-right':
                $myTaskWatermark->setVerticalPosition("bottom");
                $myTaskWatermark->setHorizontalPosition("right");
                break;
            default:
                $myTaskWatermark->setVerticalPosition("bottom");
                $myTaskWatermark->setHorizontalPosition("right");
                break;
        }
        // Execute the task
        $myTaskWatermark->execute();
        // Download the package files
        $myTaskWatermark->download('./assets/uploads/files/');
        return $signature->signature_id;
    }

    public function send_notificationEmail($email){
        // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'dssp.noreply@gmail.com',  // Email gmail
            'smtp_pass'   => 'b4ndun699',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('dssp.noreply@gmail.com', 'DSSP');

        // Email penerima
        $this->email->to($email['to']); // Ganti dengan email tujuan

        if($email['attach'] !== NULL){
            // Lampiran email, isi dengan url/path file
            $this->email->attach($email['attach']);
        }

        // Subject email
        $this->email->subject($email['subject']);

        // Isi email
        $this->email->message($email['message']);

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }
}
?>