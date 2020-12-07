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

</style>
<script type = "text/javascript">
    $( document ).ready(function() {
        $("#nav-<?php echo $curr_page; ?>").addClass('active');
    });
</script>
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-md navbar-danger bg-danger fixed-top">
        <a class="navbar-brand active" href="<?php echo base_url('index.php/page/dashboard'); ?>"><i class="fad fa-file-signature"></i> DSSP</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar" class="collapse navbar-collapse">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/dashboard'); ?>" id = "nav-dashboard" >Dashboard</a>
            </div>
        </div>
    </nav>
</div>