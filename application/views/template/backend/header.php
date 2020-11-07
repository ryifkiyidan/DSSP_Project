<style>

.active{
    color: rgba(255,255,255,1) !important;
}

/* unvisited link */
.nav-link:link {
    color: rgba(255,255,255,0.7);
}

/* visited link */
.nav-link:visited {
    color: rgba(255,255,255,0.7);
}

/* mouse over link */
.nav-link:hover {
    color: rgba(255,255,255,1);
}

/* selected link */
a.nav-link:active {
    color: rgba(255,255,255,1);
}

::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: rgba(255,255,255,0.7);
  opacity: 1; /* Firefox */
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: rgba(255,255,255,0.7);
}
::-ms-input-placeholder { /* Microsoft Edge */
  color: rgba(255,255,255,0.7);
}

.itemleft{
    margin-bottom: auto;
    margin-top: auto;
    height: 60px;
    border-radius: 30px;
    padding: 10px;
}

.searchbar{
    margin-bottom: auto;
    margin-top: auto;
    height: 60px;
    background-color: rgba(0,0,0,0.0);
    border-radius: 30px;
    padding: 10px;
}

.search_input{
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 0;
    caret-color:transparent;
    line-height: 40px;
    transition: width 0.25s linear;
}

.searchbar:hover{
    background-color: rgba(255,255,255,0.3);
}

.searchbar:hover > .search_input{
    padding: 0 10px;
    width: 300px;
    caret-color:red;
    transition: width 0.25s linear;
}

.searchbar:hover > .search_icon{
    background: white;
    color: #e74c3c;
}

.search_icon{
    height: 40px;
    width: 40px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color: white;
    text-decoration:none;
}
</style>
<script type = "text/javascript">
    $( document ).ready(function() {
        $("#nav-<?php echo $curr_page; ?>").addClass('active');
    });
</script>
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-md navbar-danger bg-danger fixed-top">
        <a class="navbar-brand active" href="<?php echo base_url('index.php/page/home'); ?>"><i class="fad fa-file-signature"></i> DSSP</a>
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
            
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/matpel'); ?>" id = "nav-matpel" >Admin</a>
            
                <?php
                }else if($this->session->userdata('role') == 'guru'){ // Jika role-nya guru
                ?>

                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/lesson'); ?>" id = "nav-lesson" >Guru</a>
                
                <?php
                }
                ?>

                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/profile'); ?>" id = "nav-profile" >Profile</a>
            
            </div>
            
            <div class="navbar-nav ml-auto">
                <div class="d-flex justify-content-center h-100">
                    <div class="searchbar">
                        <input class="search_input" type="text" name="" placeholder="Search Document...">
                        <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                    </div>
                    <div class="itemleft">
                        <a class="nav-link" href="<?php echo base_url('index.php/auth/logout'); ?>" id = "nav-logout" >Logout</a>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</div>