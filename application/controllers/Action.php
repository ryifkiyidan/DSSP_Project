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
    public function file_upload(){
        $direksi_id = $this->input->post('direksi');
        if (!empty($_FILES) && isset($_FILES['fileToUpload']) && $direksi_id !== NULL) {
            $allowedExts = array(
                "pdf"
            );
            $uploadOk = false;
            switch ($_FILES['fileToUpload']["error"]) {
                case UPLOAD_ERR_OK:
                    $file_id = md5('dok'.($this->DatabaseModel->getNumRows('dokumen')+1));
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
                            $user = $this->UserModel->getUser($this->session->userdata('email'), 'finance');
                            $data = array(
                                'dokumen_id' => $file_id,
                                'finance_id' => $user->finance_id,
                                'direksi_id' => $direksi_id,
                                'signature_id' => NULL,
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

    public function addSignature(){
        // Create a new task
        $project_id = 'project_public_28ee5d7c5e37cbc2f53fdbed954d36c9_FvWHLc3bf23eedb62e726f8987fa0f4840764';
        $project_key = 'secret_key_bc34ba5b399de41180ad0d5d9403baa2_I9L5j2d8789a22e0395179ecb8373b6ac6b10';
        $ilovepdf = new Ilovepdf($project_id,$project_key);
        $myTaskWatermark = $ilovepdf->newTask('watermark');
        // Add files to task for upload
        $file1 = $myTaskWatermark->addFile($file_loc);
        // Add Image to task
        $image = $myTaskWatermark->addFile('./assets/signature.png');
        // set mode to image
        $myTaskWatermark->setMode("image");
        // Select watermark parameters
        $myTaskWatermark->setImage($image->server_filename);
        // Execute the task
        $myTaskWatermark->execute();
        // Download the package files
        $myTaskWatermark->download();
    }
}
?>