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
    <h2  class = "form-signin-heading mb-5 text-center">Registrasi TTD</h2>
    <form method = "post" action = "<?php echo base_url('index.php/action/registrasi_ttd'); ?>" enctype="multipart/form-data">
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" accept="image/*">
            <label class="custom-file-label" for="fileToUpload">Choose file</label>
        </div>
		<button class="btn btn-lg btn-primary btn-block" type="submit" onClick="show_alert()" >Submit</button>
	</form>
</div>

<script>
  function show_alert() {
    if(!confirm("Are you sure you want to register this signature? Once registered it cannot be changed.")) {
      return false;
    }
    this.form.submit();
  }
</script>
