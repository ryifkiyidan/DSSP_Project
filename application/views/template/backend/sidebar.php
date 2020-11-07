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
</style>
<div class="bg-light sidebar pt-5 p-0">
  <div class="text-center mb-5">
    <i class="fad fa-user-circle fa-6x mb-3"></i>
    <br>
    <h6>Nama User</h6>
  </div>

  <div>
    <h5 class="mb-2 text-center"><?php echo ucwords($curr_page); ?></h5>
    <a class="btn btn-outline-danger side-item align-center" href="#">
      <div class="row" style="width: 100%;">
        <div class="col-md-3 p-0 pr-1 align-center-right">
          <i class="fas fa-th"></i>
        </div>
        <div class="col-md-9 p-0 pl-1 align-center-left">
          All Documents
        </div>
      </div>
    </a>
    <a class="btn btn-outline-danger side-item align-center" href="#">
      <div class="row" style="width: 100%;">
        <div class="col-md-3 p-0 pr-1 align-center-right">
          <i class="fas fa-check"></i>
        </div>
        <div class="col-md-9 p-0 pl-1 align-center-left">
          Approved Documents
        </div>
      </div>
    </a>
    <a class="btn btn-outline-danger side-item align-center" href="#">
      <div class="row" style="width: 100%;">
        <div class="col-md-3 p-0 pr-1 align-center-right">
          <i class="fas fa-times"></i>
        </div>
        <div class="col-md-9 p-0 pl-1 align-center-left">
          Rejected Documents
        </div>
      </div>
    </a>
    <a class="btn btn-outline-danger side-item align-center" href="#">
      <div class="row" style="width: 100%;">
        <div class="col-md-3 p-0 pr-1 align-center-right">
          <i class="fas fa-redo"></i>
        </div>
        <div class="col-md-9 p-0 pl-1 align-center-left">
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