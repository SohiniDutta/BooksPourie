<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2"></div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Master Category</h3>
                        </div>

                        <?php echo form_open_multipart('products/edit-master-category/'.$this->uri->segment(3),['role' => 'form']); ?>
                        <div class="card-body">


                            <?php 
                            $success = $this->session->userdata('success_msg'); 
                            if (!empty($success)) { ?>
                              <div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <?php echo $success; ?>
                              </div>
                            <?php } ?>

                            <?php $error = $this->session->userdata('error_msg'); 
                            if (!empty($error)) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $error; ?>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label for="">Master Category Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="master_category_name" name="category_name" placeholder="Enter master category name" value="<?php echo set_value('category_name',$details[0]['category_name']); ?>" autocomplete="off"/>
                                <small class="text-danger"><?php echo form_error('category_name'); ?></small>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                <label for="image">Image <span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control-file" accept="image/png, image/jpeg, image/jpg">
                                <small class="text-danger"><?php echo form_error('image'); ?></small>
                            </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                    <img src="<?php echo VIEW_FILE_URL.'mastercategory/'.$details[0]['image']; ?>" alt="image" class="img-thumbnail img-rounded" style=" width:100px; height:100px;">
                            </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
