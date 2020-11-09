<style>
    body {
        padding-top     : 40px;
        padding-bottom  : 40px;
        background-color: #eee;
    }
    .form-signin {
        max-width: 330px;
        padding  : 15px;
        margin   : 0 auto;
    }
    .form-signin .form-signin-heading{
        margin-bottom: 10px;
    }
    .form-signin .form-control {
        position          : relative;
        height            : auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing   : border-box;
        box-sizing        : border-box;
        padding           : 10px;
        font-size         : 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
</style>
<?php
// Cek apakah terdapat session nama message
if($this->session->flashdata('message')){ // Jika ada
  echo '<div class="alert alert-danger">'.$this->session->flashdata('message').'</div>'; // Tampilkan pesannya
}
?>
<div class = "form-signin">
    <h2  class = "form-signin-heading">Silahkan login</h2>
    <form method = "post" action = "<?php echo base_url('index.php/auth/login'); ?>">
    <div class = "form-group">
        <label>Email</label>
        <input type = "text" class = "form-control" name = "email" placeholder = "Email" required autofocus>
    </div>
    <div class = "form-group">
        <label>Password</label>
        <input type = "password" class = "form-control" name = "password" placeholder = "Password" required>
    </div>
    <button class = "btn btn-lg btn-primary btn-block" type = "submit" >Sign in</button>
</form>
</div>
