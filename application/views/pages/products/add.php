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
                            <h3 class="card-title">Add Product</h3>
                        </div>

                        <?php echo form_open_multipart('products/add',['role' => 'form']); ?>
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
                                  <div class="alert alert-danger alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                      <?php echo $error; ?>
                                  </div>
                            <?php } ?>

                            <div class="form-group">
                                 <label for="master category">Master Category <span class="text-danger">*</span></label>
                                <select class="form-control select2 master_category_id" name="master_category_id">
                                  <option value="" selected>Select master category</option>
                                  <?php foreach ($mastercatlist as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                  <?php } ?>
                                </select>
                                <small class="text-danger"><?php echo form_error('master_category_id'); ?></small>
                            </div>

                            <div class="form-group">
                               <label for="master category">Sub category</label>
                                <select class="form-control select2 sub_category_id" name="sub_category_id">
                                  <option value="" selected>Select sub category</option>
                              </select>
                                <small class="text-danger"><?php echo form_error('sub_category_id'); ?></small>
                            </div>

                            <div class="form-group">
                               <label for="master category">Brand</label>
                                <select class="form-control select2" name="brand_id">
                                  <option value="" selected>Select brand</option>
                                  <?php foreach ($brandlist as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['brand_name']; ?></option>
                                  <?php } ?>
                                </select>
                                <small class="text-danger"><?php echo form_error('brand_id'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control product_name" name="name" placeholder="Enter product name" value="<?php echo set_value('name'); ?>" autocomplete="off"/>
                                <small class="text-danger"><?php echo form_error('name'); ?></small>
                            </div>

														<div class="form-group">
                                <label for="">Company Product Id</label>
                                <input type="text" class="form-control" name="company_product_id" placeholder="Enter company product id" value="<?php echo set_value('company_product_id'); ?>" autocomplete="off"/>
                            </div>

                            <div class="form-group">
                                <label for="units">Units <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="units">
                                  <option value="">Select unit</option>
                                  <option value="kg">Kg</option>
                                  <option value="gm">Gram</option>
                                  <option value="lt">Litre</option>
                                  <option value="ml">Mili Litre</option>
                                  <option value="pcs">Piece</option>
                                </select>
                                <small class="text-danger"><?php echo form_error('units'); ?></small>
                            </div>

                            <div class="form-check form-group">
                              <input class="form-check-input" type="radio" name="is_loose" id="exampleRadios1" value="1">
                              <label class="form-check-label" for="exampleRadios1">
                                Loose Product
                              </label>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control description"><?php echo set_value('description'); ?></textarea>
                                <small class="text-danger"><?php echo form_error('description'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="specification">Specification</label>
                                <textarea name="specification" class="form-control specification"><?php echo set_value('specification'); ?></textarea>
                                <small class="text-danger"><?php echo form_error('specification'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="image">Image <span class="text-danger">*</span></label>
																<input type="file" name="image" class="form-control-file" accept="image/png, image/jpeg, image/jpg" required>
                                <small class="text-danger"><?php echo form_error('image'); ?></small>
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
