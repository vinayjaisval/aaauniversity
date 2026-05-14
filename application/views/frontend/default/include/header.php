<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AAA University | Online Education Platform</title>
    <meta name="google-site-verification" content="e_9UJriJLrVBpmhxeWUooNRp5OiXrzstWo00Oihlxu4" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link name="favicon" type="image/x-icon"
          href="<?php echo base_url('assets/frontend/default/assets/unilogo.png' ); ?>" rel="shortcut icon"/>


    <link rel="stylesheet"
          href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/icomoon.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/remixicon.css' ?>">
    <link rel="stylesheet"
          href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/magnifypopup.min.css' ?>">
    <link rel="stylesheet"
          href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/odometer.min.css' ?>">
    <link rel="stylesheet"
          href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/lightbox.min.css' ?>">
    <link rel="stylesheet"
          href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/animation.min.css' ?>">
    <link rel="stylesheet"
          href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/jqueru-ui-min.css' ?>">
    <link rel="stylesheet"
          href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/swiper-bundle.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/assets/css/vendor/tipped.min.css' ?>">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/assets/css/app.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/assets/css/app.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/assets/css/custom.css' ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7ZVJKNDGQP"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-7ZVJKNDGQP');
        </script>
        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7ZVJKNDGQP"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-7ZVJKNDGQP');
</script>
    <!--    <link rel="stylesheet" href="">-->
    <style type="text/css">
        .dropdown-menu.show {
            width: 258px;
            position: absolute !important;
            left: -14px !important;
        }


        .dropdown-menu.show li {
            margin: 0px;
            padding: 10px 0px;
        }

        .dropdown-menu.show li a {
            padding: 5px 10px;
        }

        .btn.btn-secondary.dropdown-toggle.edu-btn.btn-medium.btn-gradient.ss.logoutbtn {
            font-size: 11px;
            padding: 0px 17px;
            margin: 0px 10px !important;
        }

        <?php if ($this->session->userdata('user_login')) { ?>
        .home_header.fa.fa-search {
            position: relative;
            right: 0;
            /*padding: -82px;*/
            top: -37px;
            left: 409px;
            font-size: 21px;
            color: #00266c;
            background: none;
            border: none
        }

        input[type="search"] {
            /*padding: 1px 2px 0px 38px;*/
            width: 75% !important;
        }

        <?php }else{?>
        .home_header.fa.fa-search {
            position: relative;
            top: -37px;
            left: 409px;
            font-size: 21px;
            color: #00266c;
            background: none;
            border: none
        }

        input[type="search"] {
            padding: 1px 82px 0px 38px;
            width: 60%;
        }

        <?php }?>

        i.fa.fa-search.my_course_search {
            margin-left: -24px;
        }


        .dropdown-menu.show li a {
            padding: 14px 18px;
        }

        .dropdown-menu.show li {
            margin: 0px;
            padding: 5px 0px;
        }

        ul.dropdown-menu.show {
            border: 2px solid #eeeeee;
            border-radius: 5px;
        }

        .btn.btn-secondary.dropdown-toggle.edu-btn.btn-medium.btn-gradient.ss.logoutbtn {
            font-size: 16px !important;


            margin: 0px 8px !important;
        }

        .sbleft {
            position: absolute;
            left: -210px !important;

            /*position: absolute;*/
            top: 100%;
            /*left: 0;*/
            z-index: 1000;
            /*display: none;*/
            /*float: left;*/
            min-width: 10rem;
            /*padding: 0.25rem 0;*/
            /*margin: 0.125rem 0 0;*/
            font-size: 0.875rem;
            color: #6c757d;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d9e3e9;
            border-radius: 0.25rem;
        }
        .sbleft1 {
            position: absolute;
            left: -30px !important;

            /*position: absolute;*/
            top: 100%;
            /*left: 0;*/
            z-index: 1000;
            /*display: none;*/
            /*float: left;*/
            min-width: 10rem;
            /*padding: 0.25rem 0;*/
            /*margin: 0.125rem 0 0;*/
            font-size: 0.875rem;
            color: #6c757d;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d9e3e9;
            border-radius: 0.25rem;
        }

        .sbleft li {
            padding: 5px;
        }

        .mainmenu-nav .mainmenu li.has-droupdown .submenu li a {
            font-size: 15px;
            font-weight: 600;
            padding: 9px 17px;
        }

        .btn.btn-secondary.dropdown-toggle.edu-btn.btn-medium.btn-gradient.ss.logoutbtn {
            margin: 0px 31px !important;
        }

        .mainmenu-nav .mainmenu li.has-droupdown:hover > .submenu {
            border-radius: 7px;
            border: 2px solid #eee;
        }

        .header-action .header-btn a {
            display: block;
            color: var(--color-white);
            padding: 0 7px;
        }

        .header-action li {
            margin: 0 7px;
            line-height: 1;
        }
    </style>

</head>

<body class="sticky-header">

<?php
$user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();

?>
<div id="main-wrapper" class="main-wrapper">
    <header class="edu-header header-style-1 header-fullwidth no-topbar">
        <div id="edu-sticky-placeholder"></div>
        <div class="header-mainmenu">
            <div class="container-fluid">
                <div class="header-navbar">
                    <div class="header-brand">
                        <div class="logo">
                            <a href="<?php echo base_url() ?>">
                                <img class="logo-light"
                                     src="<?php echo base_url('assets/frontend/default/assets/unilogo.png') ?>"
                                     alt=" Logo" style="height: 83px;">
                              
                            </a>
                        </div>
                        <div class="header-category">
                            <nav class="mainmenu-nav">
                                <ul class="mainmenu">
                                    <li class="has-droupdown">
                                        <a href="#"><i class="icon-1"></i> All Courses</a>
                                        <ul class="submenu" style="overflow-y: scroll; height: 450px ; scrollbar-width: thin; "

>

                                            <?php
                                            $categories = $this->crud_model->get_categories()->result_array();
                                            foreach ($categories as $key => $category):
                                                // $icon = $this->crud_model->course_icon_by_id($category['id'])
                                                ?>
                                                <li>
                                                    <a href="<?php echo site_url('home/courses?category=' . $category['slug']); ?>">

                                                        <div class="row">
                                                            <div class="col-2"><i class="<?php echo $category['font_awesome_class'] ?>"
                                                                                  aria-hidden="true"></i></div>
                                                            <div class="col-10"><?php echo $category['name']; ?></div>
                                                        </div>

                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                            <li>
                                                <a href="<?php echo base_url('home/courses') ?>">
                                                    <div class="row">
                                                        <div class="col-2"> <i class="fa fa-atom"></i></div>
                                                        <div class="col-10">All Courses</div>
                                                    </div>


                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-mainnav">

                        <nav class="mainmenu">
                            <form action="<?php echo site_url('home/search'); ?>" method="get">
                                <!--                                    <input type="search" name="query" class="form-control"-->
                                <!--                                           placeholder="What do you want learn?">-->
                                <!--                                    <button class="search-btn" type="submit"><i class="icon-2"></i></button>-->
                                <input type="search" name='query' class="form-control" placeholder="Search"
                                       value="<?php echo $_GET['query'] ?>">
                                <!--                                    <button class="search-btn" type="submit"><i class="icon-2"></i></button>-->


                                <button type="submit" class="home_header fa fa-search"><i aria-hidden="true"></i>
                                </button>

                            </form>
                        </nav>
                    </div>

                    <div class="header-right">
                        <ul class="header-action">

                            <li class="icon search-icon">
                                <a href="javascript:void(0)" class="search-trigger">
                                    <i class="icon-2"></i>
                                </a>
                            </li>
                            
                            <?php if ($this->session->userdata('user_login')) { ?>
                                <li class="icon cart-icon" style="padding-left: 20px">
                                    <a href="<?php echo base_url('home/add_cart') ?>" class="cart-icon">
                                        <i class="icon-3"></i>
                                        <span class="count">
                                            <?php

                                            $cart_item = $this->session->userdata('course_cart');
                                            $cart_course_id = explode(',', $cart_item);
                                            $count = 0;
                                            foreach ($cart_course_id as $id) {
                                                if ($id != "") {
                                                    $count++;
                                                }
                                            }
                                            echo $count;

                                            ?>
                                        </span>
                                    </a>
                                </li>

                                <li class="header-btn">
                                    <a href="<?php echo base_url('home/branches'); ?>"
                                       class="edu-btn btn-medium btn-gradient ">
                                        <i class="fa fa-map-marker" aria-hidden="true" style="font-size: 19px;"> </i>
                                        Ours Branches</a>
                                </li>

                                <li class="header-btn">
                                    <a href="<?php echo base_url('home/my_courses') ?>"
                                       class="edu-btn btn-medium btn-gradient">
                                        <i class="fa fa-book" style="font-size: 15px;" aria-hidden="true"></i>
                                        My Courses
                                    </a>
                                </li>
                                <nav class="mainmenu-nav">
                                    <ul class="mainmenu ">
                                        <li class="has-droupdown">
                                            <?php
                                            $img = 'uploads/user_image/' . $user_details['image'] . '.jpg';
                                            if (file_exists($img)) {
                                                ?>
                                                <img src="<?php echo base_url('uploads/user_image/' . $user_details['image'] . '.jpg'); ?>"
                                                     data-bs-toggle="dropdown" aria-expanded="false"
                                                     style="height: 50px; border-radius: 50%; cursor: pointer">

                                            <?php } else {
                                                ?>
                                                <img src="<?php echo base_url('uploads/user_image/placeholder.png'); ?>"
                                                     data-bs-toggle="dropdown" aria-expanded="false"
                                                     style="height:50px; border-radius: 50%; cursor: pointer">
                                            <?php } ?>
                                            <ul class="submenu sbleft ">
                                                <li>

                                                    <div class="row">
                                                        <div class="col-md-2 col-2">
                                                            <img src="https://ekonacademy.com/uploads/user_image/placeholder.png"
                                                                 style="width: 100%;margin-left: 10px;"/>

                                                        </div>

                                                        <div class="col-md-10 col-10">
                                                            <p style="margin:0px"><b>Welcome
                                                                    <?php
                                                                    echo $user_details['first_name'] . ' ' . $user_details['last_name'];
                                                                    ?>
                                                                </b> <br>
                                                                <?php echo $user_details['email'] ?></p>

                                                        </div>
                                                    </div>

                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="<?php echo base_url('home/my_courses') ?>">
                                                        <i class="fa fa-diamond"
                                                           aria-hidden="true"></i> My courses</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="<?php echo base_url('home/my_messages') ?>">
                                                        <i class="fa fa-envelope-open" aria-hidden="true"></i> My
                                                        messages</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="<?php echo base_url('home/user_courses_purchase_history') ?>">
                                                        <i class="fas fa-money-bill-wave" aria-hidden="true"></i>
                                                        Purchase History
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="<?php echo base_url('home/profile/user_profile') ?>"> <i
                                                                class="fa fa-user"
                                                                aria-hidden="true"></i> Use
                                                        Profile</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="<?php echo base_url('user/become_an_instructor') ?>"> <i
                                                                class="fa fa-user-circle-o"
                                                                aria-hidden="true"></i> Become Instructor</a>
                                                </li>
                                                <a href="<?php echo base_url() ?>login/logout"
                                                   class="btn btn-secondary dropdown-toggle edu-btn btn-medium btn-gradient ss logoutbtn">Logout</a>
                                            </ul>
                                        </li>
                                    </ul>

                                </nav>
                            <?php } else { ?>

                                <li class="icon cart-icon">
                                    <a href="<?php echo base_url('home/add_cart') ?>" class="cart-icon">
                                        <i class="icon-3"></i>
                                        <span class="count">
                                            <?php
                                            $cart_item = $this->session->userdata('course_cart');
                                            $cart_course_id = explode(',', $cart_item);
                                            $count = 0;
                                            foreach ($cart_course_id as $id) {
                                                if ($id != "") {
                                                    $count++;
                                                }
                                            }
                                            echo $count;
                                            ?>
                                        </span>
                                    </a>
                                </li>

                                <li class="header-btn">
                                    <a href="<?php echo base_url('home/branches'); ?>"
                                       class="edu-btn btn-medium btn-gradient ">
                                        <i class="fa fa-map-marker" aria-hidden="true" style="font-size: 19px;"> </i>
                                        Our Branches</a>
                                </li>

                                <li class="header-btn">
                                    <a href="callto:8130331835" class="edu-btn btn-medium btn-gradient"> <i
                                                class="fa fa-phone" style="font-size: 19px;" aria-hidden="true"></i>
                                        (+91)
                                        8130331835 </a>
                                </li>

                                <?php if ($this->session->userdata('admin_login')) { ?>

                                    <nav class="mainmenu-nav">
                                        <ul class="mainmenu ">
                                            <li class="has-droupdown header-btn">
                                                <a
                                                   style="height: 50px !important; line-height: 51px !important; color: white; border-radius: 5px"
                                                   class="btn-secondary "> Admin </a>
                                                <ul class="submenu sbleft1 ">
                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="<?php echo base_url('admin/dashboard') ?>">
                                                            <i class="fa fa-dashboard"
                                                               aria-hidden="true"></i> Dashboard</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="<?php echo base_url('login/logout') ?>">
                                                            <i class="icon-4"
                                                               aria-hidden="true"></i> Logout </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </nav>
                                <?php } else { ?>
                                    <li class="header-btn">
                                        <a href="<?php echo base_url('home/login'); ?>"
                                           class="edu-btn btn-medium btn-gradient ss"> Sign Up/Log in <i
                                                    class="icon-4"></i></a>
                                    </li>
                                <?php }
                            } ?>

                            <li class="mobile-menu-bar d-block d-xl-none">
                                <button class="hamberger-button">
                                    <i class="icon-54"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-mobile-menu">
            <div class="inner">
                <div class="header-top">
                    <div class="logo">
                        <a href="<?php echo base_url() ?>">
                            <img class="logo-light"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/unilogo.png' ?>"
                                 alt="Corporate Logo">
                            <img class="logo-dark"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/unilogo.png' ?>"
                                 alt="Corporate Logo">
                        </a>
                    </div>
                    <div class="close-menu">
                        <button class="close-button">
                            <i class="icon-73"></i>
                        </button>
                    </div>
                </div>
                <ul class="mainmenu">
                    <li>
                        <a href="<?php echo base_url() ?>">Home</a>

                    </li>

                    <li class="has-droupdown"><a href="#">Courses</a>
                        <ul class="submenu">
                            <?php
                            $categories = $this->crud_model->get_categories()->result_array();
                            foreach ($categories as $key => $category):
                                ?>
                                <li>
                                    <a href="<?php echo site_url('home/courses?category=' . $category['slug']); ?>">

                                        <i class="<?php echo $category['font_awesome_class'] ?>" aria-hidden="true"></i>

                                        &nbsp; <?php echo $category['name']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li><a href="<?php echo base_url('home/courses') ?>">
                                    <i class="fa fa-atom"></i>
                                    &nbsp; All Courses
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo base_url('home/branches') ?>">Our Branches </a>

                    </li>

                </ul>
            </div>
        </div>
        <!-- Start Search Popup  -->
        <div class="edu-search-popup">
            <div class="content-wrap">
               
               
                    <div class="close-button">
                    <button class="close-trigger"><i class="icon-73"></i></button>
                </div>
                <div class="inner">
                    <form action="<?php echo site_url('home/search'); ?>" class="search-form" method="get">

                        <input type="search" name='query' class="edublink-search-popup-field"
                               placeholder="Search Here..."
                               value="<?php echo $_GET['query'] ?>">
                        <button type="submit" class="submit-button"><i class="icon-2"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Search Popup  -->
    </header>