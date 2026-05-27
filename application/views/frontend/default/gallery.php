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
            <!-- Gallery Item 1 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-12.jpg'); ?>" class="gallery-popup" title="Corporate Training Session 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-12.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training Session">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 2 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-13.jpg'); ?>" class="gallery-popup" title="Corporate Training Session 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-13.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training Session">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 3 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-14.jpg'); ?>" class="gallery-popup" title="Corporate Training Session 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-14.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training Session">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 4 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-15.jpg'); ?>" class="gallery-popup" title="Corporate Training Session 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-15.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training Session">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 5 (Corporate Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item campus">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-16.jpg'); ?>" class="gallery-popup" title="Corporate Training Session 5">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-16.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Corporate Training Session">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 6 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-17.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-17.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 7 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-18.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-18.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 8 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-19.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-19.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 9 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-20.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-20.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 10 (Online/Offline Batches) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item classroom">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-21.jpg'); ?>" class="gallery-popup" title="Online/Offline Batches 5">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-21.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Online/Offline Batches">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 11 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-22.jpg'); ?>" class="gallery-popup" title="Awards 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-22.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 12 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-24.jpg'); ?>" class="gallery-popup" title="Awards 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-24.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 13 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-26.jpg'); ?>" class="gallery-popup" title="Awards 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-26.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 14 (Awards) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item events">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-27.jpg'); ?>" class="gallery-popup" title="Awards 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-27.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Awards">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 15 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-28.jpg'); ?>" class="gallery-popup" title="Events 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-28.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 16 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-29.jpg'); ?>" class="gallery-popup" title="Events 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-29.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 17 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-30.jpg'); ?>" class="gallery-popup" title="Events 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-30.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 18 (Events) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item graduation">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-31.jpg'); ?>" class="gallery-popup" title="Events 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-31.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="Events">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 19 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-32.jpg'); ?>" class="gallery-popup" title="International Training 1">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-32.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 20 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-33.jpg'); ?>" class="gallery-popup" title="International Training 2">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-33.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 21 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-34.jpg'); ?>" class="gallery-popup" title="International Training 3">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-34.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 22 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-35.jpg'); ?>" class="gallery-popup" title="International Training 4">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-35.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 23 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-36.jpg'); ?>" class="gallery-popup" title="International Training 5">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-36.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
                    </a>
                </div>
            </div>

            <!-- Gallery Item 24 (International Training) -->
            <div class="col-lg-4 col-sm-6 col-6 gallery-item international">
                <div class="thumbnail">
                    <a href="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-37.jpg'); ?>" class="gallery-popup" title="International Training 6">
                        <img src="<?php echo base_url('assets/frontend/default/assets/images/gallery/gallery-37.jpg'); ?>" class="img-fluid rounded-3 w-100" alt="International Training">
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
