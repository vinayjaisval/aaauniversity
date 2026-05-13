<?php include 'include/header.php'; ?>
<style>
    .thumbnail {
        width: 100% !important;
    }
</style>
<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Instructors</h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>

                <li class="breadcrumb-item active" aria-current="page">Instactors </li>
            </ul>
        </div>
    </div>
    <ul class="shape-group">
        <li class="shape-1">
            <span></span>
        </li>
        <li class="shape-2 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-13.png') ?>" alt="shape"></li>
        <li class="shape-3 scene"><img data-depth="-2" src="<?php echo base_url('uploads/system/images/about/shape-15.png') ?>" alt="shape"></li>
        <li class="shape-4">
            <span></span>
        </li>
        <li class="shape-5 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-07.png') ?>" alt="shape"></li>
    </ul>
</div>
<div class="edu-team-area team-area-3 edu-section-gap">
    <div class="container">
        <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
            <span class="pre-title">Instructors</span>
            <h2 class="title">Course Instructors</h2>
            <span class="shape-line"><i class="icon-19"></i></span>
        </div>
        <div class="row g-5">
            <?php 
            
            foreach ($ins_list as $instructor_list) :

         
                $img = $this->user_model->get_user_image_url($instructor_list['id']);

            ?>
                <div class="col-lg-3 col-md-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="edu-team-grid team-style-2">
                        <div class="inner">
                            <div class="thumbnail-wrap">
                                <div class="thumbnail">
                                    <a href="<?php echo base_url('home/instructor_details/' . $instructor_list['id']) ?>">
                                        <img src="<?php echo $img ?>" alt="team images">
                                    </a>
                                </div>
                                <!-- <ul class="team-share-info">
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                            </ul> -->
                            </div>
                            <div class="content">
                            <h5 class="title"><a href="<?php echo base_url('home/instructor_details/' . $instructor_list['id']) ?>"> <?php echo $instructor_list['first_name'] . " " . $instructor_list['last_name'] ?></a></h5>

                                <span class="designation"><?php echo $instructor_list['designation'] ?></span>
                                <p><?php echo substr($instructor_list['biography'] , 0,100) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include "include/footer.php" ?>