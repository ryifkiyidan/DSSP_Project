<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require $_SERVER['DOCUMENT_ROOT'] . "/DSSP_Project" . '/vendor/convertapi/convertapi-php/lib/ConvertApi/autoload.php';
use \ConvertApi\ConvertApi;
class Action extends MY_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('UserModel');
    }
    public function file_upload(){
        if (!empty($_FILES) && isset($_FILES['fileToUpload'])) {
            $allowedExts = array(
                "pdf"
            ); 
            $extension = end(explode(".", $_FILES["fileToUpload"]["name"]));
            $uploadOk = false;
            switch ($_FILES['fileToUpload']["error"]) {
                case UPLOAD_ERR_OK:
                    $target = $_SERVER['DOCUMENT_ROOT'] . "/DSSP_Project/assets/uploads/files/";
                    $target = $target . basename($_FILES['fileToUpload']['name']);
                    if (in_array($extension, $allowedExts)){
                        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)) {
                            $msg = "The file " . basename($_FILES['fileToUpload']['name']) . " has been uploaded successfully";
                            $uploadOk = true;
                            // generate thumbnail
                            ConvertApi::setApiSecret('oZ5quO9fgxMI8b4s');
                            $result = ConvertApi::convert('thumbnail', [
                                    'File' => $target,
                                    'FileName' => 'thumbnail',
                                    'PageRange' => '1',
                                ], 'pdf'
                            );
                            $result->saveFiles($_SERVER['DOCUMENT_ROOT'] . "/DSSP_Project/assets/uploads/thumbnails");
                        } else {
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
            redirect('page/home');
        }
    }
}
?>