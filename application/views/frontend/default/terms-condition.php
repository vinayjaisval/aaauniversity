<?php $this->load->view('frontend/default/include/header'); ?>
<style>
    .edu-breadcrumb-area.breadcrumb-style-3 {
        padding-bottom: 30px !important;
    }
    .terms-condition-area {
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
                <li class="breadcrumb-item active" aria-current="page">Terms &amp; Condition</li>
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
                                       alt="shape"></li></ul>
</div>

<!--=====================================-->
<!--=           Cart Area Start         =-->
<!--=====================================-->
<section class="privacy-policy-area terms-condition-area">
    <div class="container">
        <div class="row row--30">
            <div class="col-lg-8">
                <div class="privacy-policy terms-condition">
                    <div class="text-block">
                        <div class="text-block">
                            <?php echo get_frontend_settings('terms_and_condition'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="edu-blog-sidebar">
                    <!-- Start Single Widget  -->
                    <div class="edu-blog-widget widget-search">
                        <div class="inner">
                            <h4 class="widget-title">Search</h4>
                            <div class="content">
                                <form class="blog-search" action="<?php echo site_url('home/search'); ?>">
                                    <button type="submit" class="search-button"><i class="icon-2"></i></button>
                                    <input type="search" name="query" placeholder="Search">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="edu-blog-widget widget-categories">
                        <div class="inner">
                            <h4 class="widget-title">Categories</h4>
                            <div class="content">
                                <ul class="category-list">
                                    <?php
                                    $categories = $this->crud_model->get_categories()->result_array();
                                    foreach ($categories as $key => $category):

//                                                    $icon = $this->crud_model->course_icon_by_id($category['id'])
                                        ?>
                                        <li>
                                            <a href="<?php echo site_url('home/courses?category=' . $category['slug']); ?>">

                                                <i class="<?php echo $category['font_awesome_class'] ?>" aria-hidden="true"></i>

                                                &nbsp; <?php echo $category['name']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
<!--                                    <li><a href="#">Business Studies <span>(3)</span></a></li>-->
<!--                                    <li><a href="#">Computer Engineering <span>(7)</span></a></li>-->
<!--                                    <li><a href="#">Medical &amp; Health<span>(2)</span></a></li>-->
<!--                                    <li><a href="#">Software <span>(1)</span></a></li>-->
<!--                                    <li><a href="#">Web Development <span>(3)</span></a></li>-->
<!--                                    <li><a href="#">Uncategorized <span>(9)</span></a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="edu-blog-widget widget-tags">
                        <div class="inner">
                            <h4 class="widget-title">Tags</h4>
                            <div class="content">
                                <div class="tag-list">
                                    <a href="#">Language</a>
                                    <a href="#">eLearn</a>
                                    <a href="#">Tips</a>
                                    <a href="<?php echo base_url('home/courses')?>">Course</a>
                                    <a href="#">Motivation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=        Footer Area Start          =-->
<!--=====================================-->

<?php $this->load->view('frontend/default/include/footer'); ?>