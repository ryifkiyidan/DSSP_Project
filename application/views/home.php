<style>
    .btn-square { 
        width        : 200px;
        height       : 200px;
        border-radius: 0;
        font-size    : 20px;
    } 
</style>
<h2 style = "margin-top: 0;">
    <small>Selamat datang</small>
    <br />
    <?php echo $this->session->userdata('first_name'); ?>
</h2>
<hr/>
<?php
// Cek role user
if($this->session->userdata('role') == 'admin'){ // Jika role-nya admin
    ?>
    <h3 class="text-center py-5"> -- Admin Panel --</h3>
    <div class="row text-center">

        <div class="col-sm-6 col-lg-6 my-1">
            <a class="btn btn-outline-primary btn-lg btn-square" href="<?php echo base_url('index.php/page/matpel');?>">
                <i class="fal fa-books fa-4x pb-3"></i>
                <br>
                Matpel
            </a>
        </div>
        <div class="col-sm-6 col-lg-6 my-1">
            <a class="btn btn-outline-primary btn-lg btn-square" href="<?php echo base_url('index.php/page/kelas');?>">
                <i class="fal fa-users-class fa-4x pb-3"></i>
                <br>
                Kelas
            </a>
        </div>
        <div class="col-sm-12 col-lg-12 my-5">
            <a class="btn btn-outline-primary btn-lg btn-square" href="<?php echo base_url('index.php/page/lesson');?>">
                <i class="fal fa-book-reader fa-4x pb-3"></i>
                <br>
                Lesson
            </a>
        </div>
        <div class="col-sm-6 col-lg-6 my-1">
            <a class="btn btn-outline-primary btn-lg btn-square" href="<?php echo base_url('index.php/page/guru');?>">
                <i class="fal fa-chalkboard-teacher fa-4x pb-3"></i>
                <br>
                Guru
            </a>
        </div>
        <div class="col-sm-6 col-lg-6 my-1">
            <a class="btn btn-outline-primary btn-lg btn-square" href="<?php echo base_url('index.php/page/siswa');?>">
                <i class="fal fa-backpack fa-4x pb-3"></i>
                <br>
                Siswa
            </a>
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