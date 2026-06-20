<?php $this->load->view('frontend/default/include/header'); ?>
<style>
    .edu-breadcrumb-area.breadcrumb-style-3 {
        padding-bottom: 30px !important;
    }
    .edu-section-gap {
        padding-top: 30px !important;
        padding-bottom: 40px !important;
    }
</style>

<div class="edu-breadcrumb-area breadcrumb-style-3">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item active" aria-current="page">Trainer Profile</li>
            </ul>
        </div>
    </div>
    <ul class="shape-group">
        <li class="shape-1">
            <span></span>
        </li>
        <li class="shape-2 scene"><img data-depth="2"
                                       src="<?php echo base_url('uploads/system/images/about/shape-13.png') ?>"
                                       alt="shape"></li>
        <li class="shape-3 scene"><img data-depth="-2"
                                       src="<?php echo base_url('uploads/system/images/about/shape-15.png') ?>"
                                       alt="shape"></li>
        <li class="shape-4">
            <span></span>
        </li>
        <li class="shape-5 scene"><img data-depth="2"
                                       src="<?php echo base_url('uploads/system/images/about/shape-07.png') ?>"
                                       alt="shape"></li>
    </ul>
</div>

<section class="edu-section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <div class="section-title section-center">
                    <span class="pre-title">Advocate Sanjeet Mishra</span>
                    <h2 class="title">Sanjeet Mishra's Professional Profile</h2>
                    <span class="shape-line"><i class="icon-19"></i></span>
                    <p>Read or download the complete profile detailing professional credentials, legal expertise, and cybersecurity training leadership.</p>
                </div>
                
                <div class="pdf-viewer-container" style="margin-top: 40px; box-shadow: 0 12px 40px rgba(0,0,0,0.12); border-radius: 16px; overflow: hidden; background: #fdfdfd; padding: 15px; border: 1px solid #eaeaea;">
                    <iframe src="<?php echo base_url('uploads/Sanjeet_Mishra_Premium_Profile.pdf'); ?>" style="width: 100%; height: 950px; border: none; border-radius: 12px;"></iframe>
                </div>
                
                <div style="margin-top: 35px;">
                    <a href="<?php echo base_url('uploads/Sanjeet_Mishra_Premium_Profile.pdf'); ?>" download class="edu-btn btn-medium">Download Profile PDF <i class="fa fa-download" style="margin-left: 8px;"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('frontend/default/include/footer'); ?>
