<style>
    .btn-square { 
        width        : 200px;
        height       : 200px;
        border-radius: 0;
        font-size    : 20px;
    } 
</style>
<?php
// Cek role user
if($this->session->userdata('role') == 'admin'){ // Jika role-nya admin
    ?>
    <div class="container align-center mb-5">
      <div class="row bg-light p-5" style="border-radius: 25px; width: 75%;">
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-6 text-center">
                    <h4>Upload Your Document</h4>
                    <p>Upload document and share your documents with others</p>
                    <br>
                    <a class="btn btn-danger btn-lg" href="#" style="border-radius: 25px;">
                        Upload Document
                        <i class="fas fa-plus ml-2"></i>
                    </a>
                  </div>
                  <div class="col-md-6 align-center">
                    <i class="fad fa-file-upload fa-10x"></i>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <hr/>
    <div class="container-fluid py-3">
      <h4>Recent Documents: </h4>
      <div class="row pt-5">
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 align-center mb-5">
            <a href="#" class="d-block mb-4 h-100">
                <i class="fad fa-file-image fa-10x"></i>
            </a>
        </div>
      </div>
    </div>

    <?php
}else if($this->session->userdata('role') == 'guru'){ // Jika role-nya guru
    ?>
    <h3 class="text-center py-5"> -- Guru Panel --</h3>
    <div class="row text-center">

        <div class="col-sm-12 col-lg-12 my-1">
            <a class="btn btn-outline-primary btn-lg btn-square" href="<?php echo base_url('index.php/page/lesson');?>">
                <i class="fal fa-book-reader fa-4x pb-3"></i>
                <br>
                Lesson
            </a>
        </div>

    </div>

    <?php
}else{?>

    <h3 class="text-center py-5"> -- Siswa Panel --</h3>
    <div class="row text-center">

        <div class="col-sm-12 col-lg-12 my-1">
            <a class="btn btn-outline-primary btn-lg btn-square" href="<?php echo base_url('index.php/page/nilai');?>">
                <i class="fal fa-file-certificate fa-4x pb-3"></i>
                <br>
                Nilai
            </a>
        </div>

    </div>

<?php
}
?>