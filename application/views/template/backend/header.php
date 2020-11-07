<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="<?php echo base_url('index.php/page/home'); ?>"><i class="fad fa-school fa-2x"></i> My School</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar" class="collapse navbar-collapse">
            <div class="navbar-nav">

                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/home'); ?>" id = "nav-home" >Home</a>
            
                <?php
                    // Cek role user
                if($this->session->userdata('role') == 'admin'){ // Jika role-nya admin
                ?>
            
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/matpel'); ?>" id = "nav-matpel" >Matpel</a>
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/kelas'); ?>" id = "nav-kelas" >Kelas</a>
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/lesson'); ?>" id = "nav-lesson" >Lesson</a>
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/guru'); ?>" id = "nav-guru" >Guru</a>
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/siswa'); ?>" id = "nav-siswa" >Siswa</a>
            
                <?php
                }else if($this->session->userdata('role') == 'guru'){ // Jika role-nya guru
                ?>

                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/lesson'); ?>" id = "nav-lesson" >Lesson</a>
                
                <?php
                }else if($this->session->userdata('role') == 'siswa'){
                ?>

                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/nilai'); ?>" id = "nav-nilai" >Nilai</a>

                <?php
                }
                ?>
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/profile'); ?>" id = "nav-profile" >Profile</a>
            
            </div>
            
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/auth/logout'); ?>" id = "nav-logout" >Logout</a>
            </div>

        </div>
        
        
    </nav>
</div>