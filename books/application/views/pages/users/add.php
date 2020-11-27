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
                            <h3 class="card-title">Add User</h3>
                        </div>

                        <?php echo form_open_multipart('users/store',['role' => 'form']); ?>
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
                                <input type="text" class="form-control" id="input_name" name="name" placeholder="Enter name" value="<?php echo set_value('name'); ?>" />
                            </div>

                            <div class="form-group">
                                <label for="">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="input_email" name="email" placeholder="Enter email" value="<?php echo set_value('email'); ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="">Mobile <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="input_mobile" name="mobile" placeholder="Mobile" value="<?php echo set_value('mobile'); ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select class="form-control" id="input_gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="input_password" name="password" placeholder="Password" autocomplete="off" />
                            </div>

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
