  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-10">
                    <h4>Products List</h4>
                  </div>
                  <div class="col-md-2">
                    <a href="<?php echo base_url('products/add'); ?>">
                    <button class="btn btn-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></a>
                  </div>
                </div>
              </div>
              <div class="card-body">

                <?php 
                $success = $this->session->userdata('success_msg'); 
                if (!empty($success)) { ?>
                  <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?php echo $success; ?>
                  </div>
                <?php } ?>

                <?php 
                $error = $this->session->userdata('error_msg'); 
                if (!empty($error)) { ?>
                  <div class="alert alert-error alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?php echo $error; ?>
                  </div>
                <?php } ?>

                <table id="productslist" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <?php if(!empty($columns)) {
                         foreach($columns as $value)  { 
                           echo '<th>'.$value.'</th>';
                         }
                      } ?>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
