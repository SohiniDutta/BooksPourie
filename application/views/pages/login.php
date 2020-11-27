<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>"><b>Admin</b>Panel</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      
      <?php 
      $sess_data = $this->session->userdata('error_msg');
      if (!empty($sess_data)) { ?>
        <div class="alert alert-danger" role="alert"><?php echo $sess_data; ?></div>
      <?php } ?>
      

      <?php echo form_open('login',array('role'=>'form')); ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4"></div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <div class="col-4"></div>
        </div>
      <?php echo form_close(); ?>
      <hr>
      <p class="text-center">
        <a href="<?php echo base_url('login/forgot-password'); ?>">I forgot my password</a>
      </p>
    </div>
  </div>
</div>