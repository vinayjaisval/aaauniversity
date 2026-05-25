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
            <button data-filter="*" class="is-checked"><span class="filter-text">International Training</span></button>
            <button data-filter=".campus"><span class="filter-text">Corporate Training</span></button>
            <button data-filter=".classroom"><span class="filter-text">Online/Offline Batches</span></button>
            <button data-filter=".events"><span class="filter-text">Awards</span></button>
            <button data-filter=".graduation"><span class="filter-text">Events</span></button>
        </div>

        <!-- Gallery Grid using native Bootstrap rows & columns to guarantee 3 items per row without spacing bugs -->
        <div class="gallery-grid-list row g-5">
            <!-- Gallery Item 1 -->
            <div class="col-lg-4 col-md-6 col-12 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-01.jpg'); ?>" class="gallery-popup" title="Campus Life">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-01.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Campus Life" style="height: 280px; object-fit: cover;">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 2 -->
            <div class="col-lg-4 col-md-6 col-12 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-02.jpg'); ?>" class="gallery-popup" title="Classroom Environment">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-02.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Classroom Study" style="height: 280px; object-fit: cover;">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 3 -->
            <div class="col-lg-4 col-md-6 col-12 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-03.jpg'); ?>" class="gallery-popup" title="Graduation Ceremony">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-03.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Graduation Ceremony" style="height: 280px; object-fit: cover;">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 4 -->
            <div class="col-lg-4 col-md-6 col-12 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-04.jpg'); ?>" class="gallery-popup" title="State-of-the-Art Library">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-04.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Library" style="height: 280px; object-fit: cover;">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 5 -->
            <div class="col-lg-4 col-md-6 col-12 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-05.jpg'); ?>" class="gallery-popup" title="Students Group Study">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-05.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Group Study" style="height: 280px; object-fit: cover;">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 6 -->
            <div class="col-lg-4 col-md-6 col-12 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-06.jpg'); ?>" class="gallery-popup" title="Advanced Science Laboratory">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-06.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Science Lab" style="height: 280px; object-fit: cover;">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 7 -->
            <div class="col-lg-4 col-md-6 col-12 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-07.jpg'); ?>" class="gallery-popup" title="Annual University Event">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-07.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="College Event" style="height: 280px; object-fit: cover;">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 8 -->
            <div class="col-lg-4 col-md-6 col-12 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-08.jpg'); ?>" class="gallery-popup" title="Academic Seminar">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-08.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Academic Seminar" style="height: 280px; object-fit: cover;">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 9 -->
            <div class="col-lg-4 col-md-6 col-12 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-09.jpg'); ?>" class="gallery-popup" title="Graduation Celebrations">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-09.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Graduation Day" style="height: 280px; object-fit: cover;">
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
