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
                            <h3 class="card-title">Edit Sub Category</h3>
                        </div>

                        <?php echo form_open('products/edit-sub-category/'.$this->uri->segment(3),['role' => 'form']); ?>
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

                            <div class="form-group">
                                <select class="form-control" name="master_category_id">
                                  <option value="">Select master category</option>
                                  <?php foreach ($mastercatlist as $key => $value) { ?>
                                    <option <?php if($value['id'] == $details[0]['master_category_id']) { echo "selected"; } ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                  <?php } ?>
                                </select>
                                <small class="text-danger"><?php echo form_error('master_category_id'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="">Sub Category <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="master_category_name" name="category_name" placeholder="Enter sub category name" value="<?php echo set_value('category_name',$details[0]['category_name']); ?>" autocomplete="off"/>
                                <small class="text-danger"><?php echo form_error('category_name'); ?></small>
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
