<style>
.sidebar{
  width: 100%;
  height: 100%;
}
.side-item{
  width: 100%;
  height: 50px;
  text-decoration: none !important;
  border-color: white;
  border-radius: 0;
  font-size: 16px;
}
.align-center{
  display: flex;
  justify-content: center;
  align-items: center;
}
.align-center-left{
  display: flex;
  justify-content: flex-start;
  align-items: center;
}
.align-center-right{
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.sidebar-footer{
  height: 50px;
  position: absolute;
  width: 100%;
  bottom: 0;
  list-style-type: none;
  padding-bottom:150px;
}
.active-sidebar{
  <?php
    if($curr_filter === 'all'){
      echo 'color: #fff; background-color: #007bff; border-color: #007bff;';
    }elseif($curr_filter === 'approved'){
      echo 'color: #fff; background-color: #28a745; border-color: #28a745;';
    }elseif($curr_filter === 'rejected'){
      echo 'color: #fff; background-color: #dc3545; border-color: #dc3545;';
    }elseif($curr_filter === 'pending'){
      echo 'color: #fff; background-color: #ffc107; border-color: #ffc107;';
    }  
  ?>
}
</style>
<div class="bg-light sidebar pt-5 p-0">
  <div class="text-center mb-5">
    <i class="fad fa-user-circle fa-6x mb-3 text-primary"></i>
    <br>
    <h6><?php echo ucwords($this->session->userdata('first_name').' '.$this->session->userdata('last_name')); ?></h6>
    <?php echo ucwords($this->session->userdata('role')); ?>
  </div>

  <div>
    <h5 class="mb-3 text-center"><?php echo ucwords($curr_page); ?></h5>
    <a class="btn btn-outline-primary side-item align-center <?php if($curr_filter==='all') echo 'active-sidebar'; ?>" href="<?php echo base_url('index.php/page/dashboard?filter=all'); ?>">
      <div class="row" style="width: 100%;">
        <div class="col-md-4 p-0 align-center">
          <i class="fad fa-copy fa-2x"></i>
        </div>
        <div class="col-md-8 p-0 align-center-left">
          All Documents
        </div>
      </div>
    </a>
    <a class="btn btn-outline-success side-item align-center <?php if($curr_filter==='approved') echo 'active-sidebar'; ?>" href="<?php echo base_url('index.php/page/dashboard?filter=approved'); ?>">
      <div class="row" style="width: 100%;">
        <div class="col-md-4 p-0 align-center">
          <i class="fad fa-file-check fa-2x"></i>
        </div>
        <div class="col-md-8 p-0 align-center-left">
          Approved Documents
        </div>
      </div>
    </a>
    <a class="btn btn-outline-danger side-item align-center <?php if($curr_filter==='rejected') echo 'active-sidebar'; ?>" href="<?php echo base_url('index.php/page/dashboard?filter=rejected'); ?>">
      <div class="row" style="width: 100%;">
        <div class="col-md-4 p-0 align-center">
          <i class="fad fa-file-times fa-2x"></i>
        </div>
        <div class="col-md-8 p-0 align-center-left">
          Rejected Documents
        </div>
      </div>
    </a>
    <a class="btn btn-outline-warning side-item align-center <?php if($curr_filter==='pending') echo 'active-sidebar'; ?>" href="<?php echo base_url('index.php/page/dashboard?filter=pending'); ?>">
      <div class="row" style="width: 100%;">
        <div class="col-md-4 p-0  align-center">
          <i class="fad fa-clock fa-2x"></i>
        </div>
        <div class="col-md-8 p-0 align-center-left">
          Pending Documents
        </div>
      </div>
    </a>
  </div>

  <div class="sidebar-footer">
    <a class="btn btn-outline-danger side-item align-center" href="<?php echo base_url('index.php/auth/logout'); ?>">
      <i class="fad fa-sign-out mr-2"></i>
      Logout
    </a>
  </div>

</div>