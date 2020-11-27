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
              <h3 class="card-title">Add Vendor</h3>
            </div>

            <?php echo form_open_multipart('vendor/store',['role' => 'form']); ?>
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
                <label for="master category">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" autocomplete="off">
                <small class="text-danger"><?php echo form_error('name'); ?></small>
              </div>

              <div class="form-group">
                <label for="master category">Mobile No.<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="mobile" value="<?php echo set_value('mobile'); ?>" autocomplete="off">
                <small class="text-danger"><?php echo form_error('mobile'); ?></small>
              </div>

              <div class="form-group">
                <label for="master category">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" autocomplete="off">
                <small class="text-danger"><?php echo form_error('email'); ?></small>
              </div>

              <div class="form-group">
                <label>Gender <span class="text-danger">*</span></label>
                <select class="form-control" id="input_gender" name="gender">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>

              <div class="form-group">
                <label for="master category">Alternative No. </label>
                <input type="text" class="form-control" name="alternative_number" value="<?php echo set_value('alternative_number'); ?>" autocomplete="off">
                <small class="text-danger"><?php echo form_error('alternative_number'); ?></small>
              </div>

              <div class="form-group">
                <label for="master category">Aadhaar No. <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="aadhaar_no" value="<?php echo set_value('aadhaar_no'); ?>" autocomplete="off">
                <small class="text-danger"><?php echo form_error('aadhaar_no'); ?></small>
              </div>

              <div class="form-group">
                <label for="master category">Pancard No. <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="pan_no" value="<?php echo set_value('pan_no'); ?>" autocomplete="off">
                <small class="text-danger"><?php echo form_error('pan_no'); ?></small>
              </div>

              <div class="form-group">
                <label for="master category">Company Name / Shop Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="company_name" value="<?php echo set_value('company_name'); ?>" autocomplete="off">
                <small class="text-danger"><?php echo form_error('company_name'); ?></small>
              </div>

              <div class="form-group">
                <label for="master category">Company Registration No. </label>
                <input type="text" class="form-control" name="company_reg_number" value="<?php echo set_value('company_reg_number'); ?>" autocomplete="off">
                <small class="text-danger"><?php echo form_error('company_reg_number'); ?></small>
              </div>

              <div class="form-group">
                <label for="master category">GST No. </label>
                <input type="text" class="form-control" name="gst_number" value="<?php echo set_value('gst_number'); ?>" autocomplete="off">
                <small class="text-danger"><?php echo form_error('gst_number'); ?></small>
              </div>

              <div class="form-group">
               <label for="master category">Business Type <span class="text-danger">*</span></label>
               <select class="form-control select2 master_category_id" name="business_type">
                <option value="" selected>Select category</option>
                <?php foreach ($mastercatlist as $key => $value) { ?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php } ?>
              </select>
              <small class="text-danger"><?php echo form_error('business_type'); ?></small>
            </div>

            <div class="form-group">
              <label for="master category">Office Address <span class="text-danger">*</span></label>
              <textarea name="office_address" cols="30" rows="3" class="form-control"><?php echo set_value('office_address'); ?></textarea>
              <small class="text-danger"><?php echo form_error('office_address'); ?></small>
            </div>

            <div class="form-group">
              <label for="master category">Office Pincode <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="office_pincode" value="<?php echo set_value('office_pincode'); ?>" autocomplete="off">
              <small class="text-danger"><?php echo form_error('office_pincode'); ?></small>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="image">User Image <span class="text-danger">*</span></label>
                  <input type="file" name="user_image" class="form-control-file" id="userImg" data-view="userImgPreview" accept="image/png, image/jpeg, image/jpg" required>
                  <small class="text-danger"><?php echo form_error('user_image'); ?></small>
                </div>
                <div class="col-md-6">
                  <img id="userImgPreview" src="<?php echo base_url().'assets/images/no_image.png'; ?>" alt="User Image" width="250px" height="250px" style="border-radius:3px;border:5px;"/>
                </div>
              </div>

            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="image">Aadhaar Card Image <span class="text-danger">*</span></label>
                  <input type="file" name="aadhaar_image" class="form-control-file" id="aadhaarImg" data-view="aadhaarImgPreview" accept="image/png, image/jpeg, image/jpg" required>
                  <small class="text-danger"><?php echo form_error('aadhaar_image'); ?></small>
                </div>
                <div class="col-md-6">
                 <img id="aadhaarImgPreview" src="<?php echo base_url().'assets/images/no_image.png'; ?>" alt="Aadhaar Image" width="250px" height="250px" style="border-radius:3px;border:5px;"/>
               </div>
             </div>
           </div>

           <div class="form-group">
             <div class="row">
              <div class="col-md-6">
                <label for="image">Pancard Image <span class="text-danger">*</span></label>
                <input type="file" name="pancard_image" class="form-control-file" id="panImg" data-view="panImgPreview" accept="image/png, image/jpeg, image/jpg" required>
                <small class="text-danger"><?php echo form_error('pancard_image'); ?></small>
              </div>
              <div class="col-md-6">
               <img id="panImgPreview" src="<?php echo base_url().'assets/images/no_image.png'; ?>" alt="Pancard Image" width="250px" height="250px" style="border-radius:3px;border:5px;"/>
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
