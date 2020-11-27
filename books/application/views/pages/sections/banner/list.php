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
                    <h4>Banner List</h4>
                  </div>
                  <div class="col-md-2">
                    <a href="<?php echo base_url('sections/add-banner'); ?>">
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

                <table id="bannerlist" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php 
                    if (!empty($banner_details['data'])) {
                      foreach ($banner_details['data'] as $key => $value) { 
                        ?>
                          <tr>
                          <td><?php echo $key+1; ?></td>
                          <td> 
                            <?php if (file_exists(UPLOAD_FILE_URL.'banner/'.$value['image'])) { ?>
                              <img src="<?php echo VIEW_FILE_URL.'banner/'.$value['image']; ?>" alt="banner" width=150 height=100>
                            <?php } else { ?>
                              <img  src="<?php echo base_url().'assets/images/no_image.png'; ?>" alt="banner" width=150 height=100>
                            <?php } ?>
                            
                          </td>
                          <td><?php echo !empty($value['title'])?ucfirst($value['title']):''; ?></td>
                          <td><?php 
                            if($value['status'] == '1') {
                                echo '<span class="badge badge-success">Active</span>';
                              } else {
                                echo '<span class="badge badge-warning">Inactive</span>';
                              }
                           ?></td>
                          <td>
                            <div class="dropdown"><a class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fs-14 fa fa-bars"></i></a><ul class="dropdown-menu dropdown-menu-right" aria-labelledby="about-us"><li style="text-align: center;"><a data-id="<?php echo $value['id'] ?>" class="dropdown-item banner_edit" href="javascript:void(0)" data-toggle="modal" style="color: blue;"><i class="fa fa-edit" style="margin-right: 3px;" aria-hidden="true"></i>Edit</a></li><li style="text-align: center;"><a class="dropdown-item banner_delete" data-id="<?php echo $value['id'] ?>" href="javascript:void(0)" data-toggle="modal" style="color: grey;"><i class="fa fa-toggle-on" style="margin-right: 3px;" aria-hidden="true"></i>Delete</a></li></ul></div>
                          </td>
                        </tr>
                    <?php }
                    }  else {
                      echo "<tr><td colspan='4'><center>No record found</center></td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
