<?php $this->load->view('frontend/default/include/header'); ?>

<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Photo Gallery</h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item active" aria-current="page">Gallery</li>
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

<!--=====================================-->
<!--=           Gallery Area Start      =-->
<!--=====================================-->
<section class="edu-section-gap bg-image">
    <div class="container">
        <!-- Filter Menu using native theme filters -->
        <div class="isotop-button isotop-filter justify-content-center">
            <button data-filter=".international"><span class="filter-text">International Training</span></button>
            <button data-filter=".campus" class="is-checked"><span class="filter-text">Corporate Training</span></button>
            <button data-filter=".classroom"><span class="filter-text">Online/Offline Batches</span></button>
            <button data-filter=".events"><span class="filter-text">Awards</span></button>
            <button data-filter=".graduation"><span class="filter-text">Events</span></button>
        </div>

        <!-- Gallery Grid using responsive row gutters and column breakpoints -->
        <div class="gallery-grid-list row g-3 g-md-4">
            
            <!-- ========================================== -->
            <!-- Corporate Training (Items 1 - 10)          -->
            <!-- ========================================== -->
            
            <!-- Gallery Item 1 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-12.jpg'); ?>" class="gallery-popup" title="Corporate Training 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-12.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 2 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-38.jpg'); ?>" class="gallery-popup" title="Corporate Training 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-38.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 3 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-39.jpg'); ?>" class="gallery-popup" title="Corporate Training 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-39.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 4 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-40.jpg'); ?>" class="gallery-popup" title="Corporate Training 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-40.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 5 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-41.jpg'); ?>" class="gallery-popup" title="Corporate Training 5">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-41.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 6 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-42.jpg'); ?>" class="gallery-popup" title="Corporate Training 6">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-42.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 7 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-15.jpg'); ?>" class="gallery-popup" title="Corporate Training 7">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-15.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 8 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-16.jpg'); ?>" class="gallery-popup" title="Corporate Training 8">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-16.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 9 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-43.jpg'); ?>" class="gallery-popup" title="Corporate Training 9">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-43.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 10 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-44.jpg'); ?>" class="gallery-popup" title="Corporate Training 10">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-44.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training">
                    </a>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- Online/Offline Batches (Items 11 - 20)     -->
            <!-- ========================================== -->

            <!-- Gallery Item 11 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-17.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-17.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 12 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-18.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-18.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 13 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-19.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-19.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 14 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-20.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-20.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 15 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-21.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 5">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-21.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 16 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-45.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 6">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-45.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 17 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-46.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 7">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-46.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 18 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-47.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 8">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-47.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 19 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-48.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 9">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-48.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 20 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-49.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 10">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-49.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- Awards (Items 21 - 30)                     -->
            <!-- ========================================== -->


            <!-- Gallery Item 21 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-24.jpg'); ?>" class="gallery-popup" title="Awards 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-24.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 22 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-26.jpg'); ?>" class="gallery-popup" title="Awards 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-26.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 23 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-50.jpg'); ?>" class="gallery-popup" title="Awards 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-50.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 24 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-51.jpg'); ?>" class="gallery-popup" title="Awards 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-51.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 25 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-52.jpg'); ?>" class="gallery-popup" title="Awards 5">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-52.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 26 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-53.jpg'); ?>" class="gallery-popup" title="Awards 6">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-53.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 27 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-54.jpg'); ?>" class="gallery-popup" title="Awards 7">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-54.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 28 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-57.jpg'); ?>" class="gallery-popup" title="Awards 8">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-57.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 29 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-56.jpg'); ?>" class="gallery-popup" title="Awards 9">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-56.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 30 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-80.jpg'); ?>" class="gallery-popup" title="Awards 10">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-80.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>




            <!-- ========================================== -->
            <!-- Events (Items 28 - 37)                     -->
            <!-- ========================================== -->

            <!-- Gallery Item 28 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-28.jpg'); ?>" class="gallery-popup" title="Events 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-28.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 29 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-29.jpg'); ?>" class="gallery-popup" title="Events 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-29.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 30 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-31.jpg'); ?>" class="gallery-popup" title="Events 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-31.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 31 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-63.jpg'); ?>" class="gallery-popup" title="Events 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-63.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 32 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-64.jpg'); ?>" class="gallery-popup" title="Events 5">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-64.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 33 (Events) -->
            <!-- <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-66.jpg'); ?>" class="gallery-popup" title="Events 6">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-66.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div> -->

            <!-- Gallery Item 34 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-67.jpg'); ?>" class="gallery-popup" title="Events 7">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-67.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 35 (Events) -->
            <!-- <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-68.jpg'); ?>" class="gallery-popup" title="Events 8">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-68.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div> -->

            <!-- Gallery Item 36 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-69.jpg'); ?>" class="gallery-popup" title="Events 9">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-69.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 37 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-70.jpg'); ?>" class="gallery-popup" title="Events 10">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-70.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- International Training (Items 38 - 47)     -->
            <!-- ========================================== -->


            <!-- Gallery Item 38 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-73.jpg'); ?>" class="gallery-popup" title="International Training 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-73.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 39 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-33.jpg'); ?>" class="gallery-popup" title="International Training 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-33.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 40 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-74.jpg'); ?>" class="gallery-popup" title="International Training 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-74.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 41 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-35.jpg'); ?>" class="gallery-popup" title="International Training 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-35.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 42 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-36.jpg'); ?>" class="gallery-popup" title="International Training 5">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-36.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 43 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-75.jpg'); ?>" class="gallery-popup" title="International Training 6">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-75.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 44 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-76.jpg'); ?>" class="gallery-popup" title="International Training 7">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-76.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 45 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-77.jpg'); ?>" class="gallery-popup" title="International Training 8">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-77.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 46 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-78.jpg'); ?>" class="gallery-popup" title="International Training 9">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-78.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 47 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-79.jpg'); ?>" class="gallery-popup" title="International Training 10">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-79.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>



        </div>
    </div>
</section>

<?php $this->load->view('frontend/default/include/footer'); ?>

<!-- Custom Script for Responsive Filtering and Lightbox -->
<script type="text/javascript">
    $(document).ready(function() {
        // Tab Filtering Logic: robust jQuery display system
        $('.isotop-filter').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $(this).addClass('is-checked').siblings().removeClass('is-checked');
            
            if (filterValue === '*') {
                $('.gallery-grid-list .gallery-item').fadeIn(400);
            } else {
                $('.gallery-grid-list .gallery-item').each(function() {
                    if ($(this).is(filterValue)) {
                        $(this).fadeIn(400);
                    } else {
                        $(this).fadeOut(200);
                    }
                });
            }
        });

        // Trigger initial filtering for default active tab (Corporate Training)
        $('.isotop-filter button.is-checked').trigger('click');

        // Initialize Magnific Popup Gallery
        $('.gallery-popup').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') || '';
                }
            },
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    });
</script>
