<?php
include 'include/header.php';

$branch = $this->db->get('branch_location')->result_array();
?>
<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Branch Location</h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item"><a href="#">Branch Location</a></li>

            </ul>
        </div>
    </div>
    <ul class="shape-group">
        <li class="shape-1">
            <span></span>
        </li>
        <li class="shape-2 scene"><img data-depth="2"
                                       src="<?php echo base_url('assets/frontend/default/assets/images/about/shape-13.png') ?>"
                                       alt="shape"></li>
        <li class="shape-3 scene"><img data-depth="-2"
                                       src="<?php echo base_url('assets/frontend/default/assets/images/about/shape-15.png') ?>"
                                       alt="shape"></li>
        <li class="shape-4">
            <span></span>
        </li>
        <li class="shape-5 scene"><img data-depth="2"
                                       src="<?php echo base_url('assets/frontend/default/assets/images/about/shape-07.png') ?>"
                                       alt="shape"></li>
    </ul>
</div>

<!--=====================================-->
<!--=       Contact Me Area Start       =-->
<!--=====================================-->

<?php
foreach ($branch as $branch_data) {
    $state_data = $this->db->get_where('states', array('id' => $branch_data['state']))->result_object();
    $city_data = $this->db->get_where('cities', array('id' => $branch_data['city']))->result_object();
    ?>
    <section class="section-gap-equal contact-me-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="contact-me">
                        <div class="inner">
                            <div class="thumbnail">
                                <div class="thumb">
                                    <img src="<?php echo base_url('uploads/branch_image/' . $branch_data['branch_image']) ?>"
                                         alt="Contact Me">
                                </div>
                                <ul class="shape-group">
                                    <li class="shape-1 scene">
                                        <img data-depth="1.4"
                                             src="<?php echo base_url('assets/frontend/default/assets/images/about/shape-13.png') ?>"
                                             alt="Shape">
                                    </li>
                                    <li class="shape-2 scene">
                                        <img data-depth="-1.4"
                                             src="<?php echo base_url('assets/frontend/default/assets/images/about/shape-02.png') ?>"
                                             alt="Shape">
                                    </li>
                                    <li class="shape-3">
                                        <img src="<?php echo base_url('assets/frontend/default/assets/images/about/shape-07.png') ?>"
                                             alt="Shape">
                                    </li>
                                </ul>
                            </div>
                            <div class="contact-us-info">
                                <h3 class="heading-title"><?php echo $branch_data['branch_name'] ?></h3>
                                <ul class="address-list">
                                    <li>
                                        <h5 class="title">Address</h5>
                                        <p><?php echo $branch_data['address'] ?>
                                            <?php if ($city_data[0]->name != '' && $state_data[0]->name != '') {
                                                echo  ', '.$city_data[0]->name . ', ' . $state_data[0]->name;
                                            }
                                            ?></p>
                                    </li>
                                    <li>
                                        <h5 class="title">Email</h5>
                                        <p><a href="mailto:<?php echo $branch_data['email'] ?>">
                                                <?php echo $branch_data['email'] ?></a></p>
                                    </li>
                                    <li>
                                        <div class="col-md-12 row">
                                            <div class="col-md-6">
                                                <h5 class="title"> Location</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="title"> Batch</h5>
                                            </div>
                                        </div>


                                    </li>

                                    <li class="header-btn ">

                                        <div class="col-md-12 row">
                                            <div class="col-md-6">
                                                <a href="<?php echo $branch_data['google_map_link'] ?>"
                                                   class="edu-btn btn-medium btn-gradient ss"
                                                   style="color: white!important;">
                                                    <i
                                                            class="fa fa-map-marker" aria-hidden="true"
                                                            style="font-size: 19px;color:white"> </i>
                                                    Location
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="<?php echo base_url('home/batch/' . $branch_data['state'] . '-' . $branch_data['city']) ?>"
                                                   class="edu-btn btn-medium btn-gradient ss"
                                                   style="color: white!important;">
                                                    <img src="<?php echo base_url('assets/frontend/default/group_icon.png') ?>"
                                                         style="height: 24px !important;">
                                                    Batch
                                                </a>
                                            </div>
                                        </div>


                                    </li>
                                </ul>
                                <ul class="social-share">

                                    <?php $link = json_decode($branch_data['social_link'], true);
                                    ?>
                                    <li id="shareBtn<?php echo $branch_data['id'] ?>"><a href="#"><i
                                                    class="icon-share-alt"></i></a></li>
                                    <li><a href="<?php echo $link['facebook'] ?>"><i class="icon-facebook"></i></a></li>
                                    <li><a href="<?php echo $link['twitter'] ?>"><i class="icon-twitter"></i></a></li>
                                    <li><a href="<?php echo $link['linkedin'] ?>"><i class="icon-linkedin2"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        document.querySelector("#shareBtn<?php echo $branch_data['id']?>")
            .addEventListener('click', event => {

                // Fallback, Tries to use API only
                // if navigator.share function is
                // available
                if (navigator.share) {
                    navigator.share({

                        // Title that occurs over
                        // web share dialog
                        title: 'Ekon Academy',

                        // URL to share
                        url: 'https://ekonacademy.com/'
                    }).then(() => {
                        alert('Thanks For Shearing')
                    }).catch(err => {

                        // Handle errors, if occured
                        console.log(
                            "Error while using Web share API:");
                        console.log(err);
                    });
                } else {

                    // Alerts user if API not available
                    alert("Sorry! Your Browser doesn't support this!");
                }
            })
    </script>
<?php } ?>
<!--=====================================-->
<!--=      Contact Form Area Start      =-->
<!--=====================================-->
<section class="edu-section-gap contact-form-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form">
                    <div class="section-title section-center">
                        <h3 class="title">Just Drop Me a Line</h3>
                    </div>
                    <form class="" id="contact-form" method="POST"
                          action="<?php echo base_url('home/contact_us_form') ?>">
                        <div class="row row--10">
                            <div class="form-group col-lg-6">
                                <input type="text" onkeypress="return /[a-z]/i.test(event.key)" name="contact-name"
                                       id="contact-name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="email" name="contact-email" id="contact-email" placeholder="Your Email"
                                       required>
                            </div>
                            <div class="form-group col-12">
                                <input type="text" onkeypress="return /[0-9]/i.test(event.key)" maxlength="10"
                                       name="contact-phone" id="contact-phone" placeholder="Phone number" required>
                            </div>
                            <div class="form-group col-12">
                                <textarea name="contact-message" id="contact-message" cols="30" rows="6"
                                          placeholder="Type your message" required></textarea>
                            </div>
                            <div class="form-group col-12 text-center">
                                <button class="edu-btn submit-btn" name="submit" type="submit">Submit Now <i
                                            class="icon-4"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <ul class="shape-group">
        <li class="shape-1 scene"><img data-depth="-2"
                                       src="<?php echo base_url('assets/frontend/default/assets/images/about/shape-15.png') ?>"
                                       alt="shape"></li>
        <li class="shape-2 scene"><img data-depth="2"
                                       src="<?php echo base_url('assets/frontend/default/assets/images/about/shape-04.png') ?>"
                                       alt="shape"></li>
        <li class="shape-3 scene"><span data-depth="1"></span></li>
        <li class="shape-4 scene"><img data-depth="-2"
                                       src="<?php echo base_url('assets/frontend/default/assets/images/about/shape-13.png') ?>"
                                       alt="shape"></li>
    </ul>
</section>
<!--=====================================-->
<!--=        Footer Area Start          =-->
<!--=====================================-->
<!-- Start Footer Area  -->
<?php include 'include/footer.php'; ?>

<script>
    document.querySelector('#shareBtn')
        .addEventListener('click', event => {

            // Fallback, Tries to use API only
            // if navigator.share function is
            // available
            if (navigator.share) {
                navigator.share({

                    // Title that occurs over
                    // web share dialog
                    title: 'Ekon Academy',

                    // URL to share
                    url: 'https://geeksforgeeks.org'
                }).then(() => {
                    console.log('Thanks for sharing!');
                }).catch(err => {

                    // Handle errors, if occured
                    console.log(
                        "Error while using Web share API:");
                    console.log(err);
                });
            } else {

                // Alerts user if API not available
                alert("Browser doesn't support this API !");
            }
        })
</script>