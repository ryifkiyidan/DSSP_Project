<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset    = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name       = "viewport" content        = "width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name = "description" content = "Project">
    <meta name = "author" content      = "WeAre">
    
    <title>DSSP - <?php echo ucwords($curr_page);?></title>

    <!-- Load File CSS Bootstrap  -->
    <link href = "<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel = "stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src = "https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src = "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    body {
        min-height : 2000px;
        padding-top: 70px;
    }
    </style>
    <!-- Load file Javascript FontAwesome, Bootstrap & jQuery -->
    <script src  = "<?php echo base_url('assets/js/fontawesome.js');?>"></script>
    <script src  = "<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src  = "<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

</head>
<body>
    <!-- Fixed navbar -->
    <?php
    /*
    * Variabel $headernya diambil dari core MY_Controller
    * (application/core/MY_Controller.php)
    * */
        if($curr_page !== "login") echo $headernya;
    ?>

    <div class="row">
        <div class="col-md-3 col-lg-2 d-none d-md-block bg-light position-fixed p-0" style="height: 100%;">
            <?php if($curr_page !== "login") echo $sidebarnya; ?>
        </div>
        <div class="col-md-9 ml-sm-auto col-lg-10 p-5">
            <?php echo $contentnya; ?>
        </div>
    </div>
</body>
</html>