<div class='content-wrapper'>
    <section class='content-header'>
        <div class='container-fluid'>
            <div class='row mb-2'></div>
        </div>
    </section>

    <section class='content'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card card-primary'>
                        <div class='card-header'>
                            <h3 class='card-title'>Add Banner</h3>
                        </div>

                        <?php echo form_open_multipart('sections/add-banner',['role' => 'form']); ?>
                        <div class='card-body'>

                            <?php $success = $this->session->userdata('success_msg'); 
                            if (!empty($success)) { ?>
                              <div class='alert alert-success alert-dismissible'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                  <?php echo $success; ?>
                              </div>
                            <?php } ?>

                            <?php $error = $this->session->userdata('error_msg'); 
                            if (!empty($error)) { ?>
                                <div class='alert alert-danger alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                    <?php echo $error; ?>
                                </div>
                            <?php } ?>

                            <div class='form-group'>
                                <label for='banner'>Banner <span class='text-danger'>*</span></label>
                                <input type='hidden' name='type' value='banner'>
                                <input type='file' class='form-control-file' name='image' accept='image/png, image/jpeg, image/jpg' required />
                                <small class='text-danger'><?php echo form_error('image'); ?></small>
                            </div>

                            <div class='form-group'>
                                <label for='title'>Title <span class='text-danger'>*</span></label>
                                <input type='text' name='title' class='form-control' value='<?php echo set_value("title"); ?>' autocomplete='off'>
                                <small class='text-danger'><?php echo form_error('title'); ?></small>
                            </div>

                            <div class='form-group'>
                                <label for='description'>Description</label>
                                <textarea name='description' class='form-control' autocomplete='off'><?php echo set_value("description"); ?></textarea>
                                <small class='text-danger'><?php echo form_error('description'); ?></small>
                            </div>
                        </div>

                        <div class='card-footer'>
                            <button type='submit' class='btn btn-primary'>Submit</button>
                            <button type='reset' class='btn btn-default'>Reset</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
