<div class="d-flex flex-column flex-md-row align-items-center justify-content-center vh-100">
    <div id="clientRegister" class="box mb-3 mb-md-0" style="border-left:0px;background-image: url('<?php echo base_url('assets/images/left-login.png') ?>');">
        <span>
            <?php echo trans('register-client'); ?>
        </span>
    </div>
    <div id="staffRegister" class="box ml-md-auto" style="border-right:0px;background-image: url('<?php echo base_url('assets/images/right-login.png') ?>');">
        <span>
            <?php echo trans('register-beauty-specialist'); ?>
        </span>
    </div>
</div>

<style>
    body {
        background-color: #bcb3b6 !important;
    }

    .box {
        height: 200px;
        width: 100%;
        background-size: cover;
        background-position: center;
        border: 15px solid white;
        cursor: pointer;
    }

    .box span {
        color: black;
        font-size: 25px;
    }

    @media (min-width: 768px) {
        .box {
            height: 300px;
            width: 48%;
        }
    }
</style>