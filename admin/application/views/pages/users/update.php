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
                            <h3 class="card-title">Edit User</h3>
                        </div>

                        <?php echo form_open_multipart('users/update/'.$this->uri->segment(3),['role' => 'form']); ?>
                        <div class="card-body">
                            <?php $error = $this->session->userdata('error_msg'); 
                            if (!empty($error)) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $error; ?>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label for="">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="input_name" name="name" placeholder="Enter name" value="<?php echo set_value('name',$user_info['name']); ?>" />
                                <small class="text-danger"><?php echo form_error('name'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="input_email" name="email" placeholder="Enter email" value="<?php echo set_value('email',$user_info['email']); ?>" autocomplete="off" />
                                <small class="text-danger"><?php echo form_error('email'); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="">Mobile <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="input_mobile" name="mobile" placeholder="Mobile" value="<?php echo set_value('mobile',$user_info['mobile']); ?>" autocomplete="off" />
                                <small class="text-danger"><?php echo form_error('mobile'); ?></small>
                            </div>

                            <div class="form-group">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select class="form-control" id="input_gender" name="gender">
                                    <option <?php echo ($user_info['gender']=='male')?'selected':''; ?> value="male">Male</option>
                                    <option <?php echo ($user_info['gender']=='female')?'selected':''; ?> value="female">Female</option>
                                </select>
                                <small class="text-danger"><?php echo form_error('gender'); ?></small>
                            </div>

                            <!-- <div class="form-group">
                                <label for="">Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="user_address" class="form-control" cols="10" rows="2"><?php //echo set_value('address'); ?></textarea>
                            </div> -->

                           <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="input_file" name="files" accept="image/x-png,image/jpg,image/jpeg"/>
                                                <label class="custom-file-label" for="">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                               <div class="col-md-6">
                                   <?php 
                                    $imageurl = ($user_info['image'])?VIEW_FILE_URL.'users/'.$user_info['image']:base_url().'assets/images/no_image.png';
                                   ?>
                                   <img src="<?php echo $imageurl; ?>" alt="user image" class="img-responsive img-thumbnail rounded" width="200" height="200">
                               </div>
                           </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
