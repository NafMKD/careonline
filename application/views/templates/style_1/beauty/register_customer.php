<div class="d-flex align-items-center position-relative min-vh-100 mb-6">

    <!-- Register form -->
    <div class="container">
        <div class="row justify-content-center justify-content-lg-starts">
            <div class="col-md-8 col-lg-7 col-xl-7 offset-lg-1 offset-xl-2 my-1" data-aos="fade-left" data-aos-duration="200">
                <div class="mb-6 text-center">
                    <h3 class="mb-0 custom-font"><?php echo trans('register-client') ?></h3>
                </div>

                <div class="mb-4 mt-4">
                    <div class="success text-success"></div>
                    <div class="success_extend text-success"></div>
                    <div class="error text-danger"></div>
                    <div class="warning text-warning"></div>
                </div>

                <div class="card add_area">

                    <form id="beauty_staff_register_form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('company/add_customer_for_beauty') ?>" role="form" novalidate>
                        <div class="card-body">


                            <div class="form-group">
                                <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="<?php echo trans('your-full-name') ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"><?php echo trans('phone') ?> <span class="text-danger">*</span></label>
                                <div class="input-phone"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="example-input-normal"><?php echo trans('companies') ?> <span class="text-danger">*</span></label>
                                <select class="form-control custom-select location" name="company_id" >
                                    <option value=""><?php echo trans('select') ?></option>
                                    <?php foreach ($companies as $company) : ?>
                                        <option value="<?php echo html_escape($company->uid); ?>">
                                            <?php echo html_escape($company->name); ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" placeholder="<?php echo trans('your-email-address') ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo trans('password') ?> <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="new_password" placeholder="<?php echo trans('your-password') ?>">
                            </div>


                        </div>

                        <div class="card-footer">
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <button type="submit" class="btn btn-primary pull-right register_button"> <?php echo trans('register') ?></button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Left Content -->
    <div class="jarallaxs overlays overlay-primarys overlay-70s col-lg-5 col-xl-5 d-none d-lg-flex align-items-center h-100vh px-0 mr-0" data-aos="fade-right" data-aos-duration="400">
        <div class="w-lg-85 p-5 text-center">


            <img src="<?php echo base_url('assets/images/left-login.png') ?>" style="border-radius: 5%;" />

        </div>
    </div>
</div>