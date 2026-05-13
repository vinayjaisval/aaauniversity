<?php include 'include/header.php'; ?>


<style>
    .blog {
        top: 50%;
        left: 50%;
        width: 100%;
        padding: 30px;
        /* background:black; */
        box-sizing: border-box;
        /* border-radius:10px; */


    }

    .circle {
        height: 216px;
        border-radius: 54%;
        float: left;
        shape-outside: circle();
        margin: 0px 21px 24px -12px;
        text-align: justify;
    }
</style>

<div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--21">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title"> Instructors' Details</h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item">Instructors' Details</li>
            </ul>
        </div>
    </div>
</div>

<!--=====================================-->
<!--=     Courses Details Area Start    =-->
<!--=====================================-->
<section class="edu-section-gap course-details-area">
    <div class="container">
        <div class="row row--30">
            <div class="col-lg-8">
                <div class="course-details-content course-details-3">
                    <div class="entry-content">
                        <h3 class="widget-title"><i class="icon-58"></i> <?php echo $instructor_details['first_name']." ".$instructor_details['last_name']?></h3>
                        <ul class="course-meta">
<!--                            <li></li>-->
                            <li><i class="icon-59"></i><?php echo $instructor_details['designation']?></li>
<!--                            <li class="course-rating">-->
<!--                                <div class="rating">-->
<!--                                    <i class="icon-23"></i>-->
<!--                                    <i class="icon-23"></i>-->
<!--                                    <i class="icon-23"></i>-->
<!--                                    <i class="icon-23"></i>-->
<!--                                    <i class="icon-23"></i>-->
<!--                                </div>-->
<!--                                <span class="rating-count">(720 Rating)</span>-->
<!--                            </li>-->
                        </ul>


                    </div>


                    <div class="blog">
                        <div class="row">
                            <div class="circle">
                                <?php
                                //    print_array($instructor_details);
                                //    die();
                                $img = $this->user_model->get_user_image_url($instructor_details['id']);
                                ?>
                                <img alt="" src="<?php echo $img ?>" class="img-responsive circle">
                                <?php echo $instructor_details['biography'] ?>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="col-lg-4">
                <div class="course-sidebar-3">
                    <div class="edu-course-widget widget-course-summery">
                        <div class="inner">
                            <div class="content">
                                <h4 class="widget-title">Instructor:</h4>
                                <ul class="course-item">
                                    <li>
                                        <span class="label"><i class="icon-62"></i>Instructor:</span>
                                        <span class="value"><?php echo $instructor_details['first_name']." ".$instructor_details['last_name']?></span>
                                    </li>

                                </ul>
                                <div class="share-area">
                                    <h5 class="title">Social Link :</h5>

                                    <?php
                                    $dats = json_decode($instructor_details['social_links'], true);
                                    ?>
                                    <ul class="social-share">
                                        <li><a href="<?php echo ($dats['facebook'] == '') ? '' : $dats['facebook'] ?>"
                                               target="<?php echo ($dats['facebook'] == '') ? '_self' : '_blank' ?>"><i
                                                        class="icon-facebook"></i></a></li>
                                        <li><a href="<?php echo ($dats['twitter'] == '') ? '' : $dats['twitter'] ?>"
                                               target="<?php echo ($dats['facebook'] == '') ? '_self' : '_blank' ?>"><i
                                                        class="icon-twitter"></i></a></li>
                                        <li><a href="<?php echo ($dats['linkedin'] == '') ? '' : $dats['linkedin'] ?>"
                                               target="<?php echo ($dats['facebook'] == '') ? '_self' : '_blank' ?>"><i
                                                        class="icon-linkedin2"></i></a></li>
                                        <!--                                            <li><a href="#"><i class="icon-youtube"></i></a></li>-->
                                    </ul>
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
<!-- Start Footer Area  -->
<?php include 'include/footer.php'; ?>
