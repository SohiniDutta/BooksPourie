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
                            <h3 class="card-title"><?php echo ucfirst($pro_details['name']).' price'; ?></h3>
                        </div>

                        <?php echo form_open('products/addprice/'.$this->uri->segment(3),['role' => 'form']); ?>
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
                                <label for="">Product Name <span class="text-danger">*</span></label>
                                <input type="hidden" name="pr_cost_id" value="<?php echo $pro_details['pr_cost_id']; ?>">
                                <input type="hidden" name="pro_id" value="<?php echo $pro_details['pro_id']; ?>">
                                <input type="text" class="form-control product_name" name="name" placeholder="Enter product name" value="<?php echo set_value('name',$pro_details['name']); ?>" autocomplete="off" readonly />
                            </div>

                            <div class="form-group">
                                <label for="units">Units <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="units" readonly>
                                  <option value="">Select unit</option>
                                  <option <?php if($pro_details['units'] == 'kg') { echo "selected"; } ?> value="kg">Kg</option>
                                  <option <?php if($pro_details['units'] == 'gm') { echo "selected"; } ?> value="gm">Gram</option>
                                  <option <?php if($pro_details['units'] == 'lt') { echo "selected"; } ?> value="lt">Litre</option>
                                  <option <?php if($pro_details['units'] == 'ml') { echo "selected"; } ?> value="ml">Mili Litre</option>
                                  <option <?php if($pro_details['units'] == 'pcs') { echo "selected"; } ?> value="pcs">Piece</option>
                                </select>
                                <small class="text-danger"><?php echo form_error('units'); ?></small>
                            </div>
                            <div class="form-check form-group">
                              <input class="form-check-input" type="radio" name="is_loose" id="exampleRadios1" value="1" <?php echo !empty($pro_details['is_loose'])?'checked':''; ?>>
                              <label class="form-check-label" for="exampleRadios1">
                                Loose Product
                              </label>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="input-group">
                                  <img src="<?php echo (file_exists(UPLOAD_FILE_URL.'products/'.$pro_details['image_250']))?VIEW_FILE_URL.'products/'.$pro_details['image_250']:base_url().'assets/images/no_image.png'; ?>" alt="<?php echo $pro_details['name']; ?>" class="img-thumbnail rounded mx-auto d-block">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mrp price">MRP Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control product_mrp" name="product_mrp" placeholder="Enter mrp price" autocomplete="off"
                                 value="<?php echo set_value('product_mrp',$pro_details['product_mrp']); ?>" />
                                <small class="text-danger"><?php echo form_error('product_mrp'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="price">Website Price <span class="text-danger">*</span></label>

                                <input type="hidden" name="type" value="<?php echo (!empty($pro_details['website_cost'])) ? 'update' : 'insert'; ?>">
                                <input type="text" class="form-control website_cost" name="website_cost" placeholder="Enter website price" autocomplete="off" value="<?php echo set_value('website_cost',$pro_details['website_cost']); ?>"/>
                                <small class="text-danger"><?php echo form_error('website_cost'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="discount">Discount Price</label>
                                <input type="text" class="form-control product_discount" name="product_discount" placeholder="Enter discounted price" autocomplete="off" value="<?php echo set_value('product_discount',$pro_details['product_discount']); ?>"/>
                                <small class="text-danger"><?php echo form_error('product_discount'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="state">Choose State <span class="text-danger">*</span></label>
                                <select name="state" class="form-control">
                                  <option value="west_bengal">West Bengal</option>
                                </select>
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
