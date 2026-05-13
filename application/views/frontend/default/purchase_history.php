<?php

$this->load->view('frontend/default/include/header');
//print_r($purchase_details->result_array());
?>
    <!--=====================================-->
    <!--=       Breadcrumb Area Start      =-->
    <!--=====================================-->


    <div class="edu-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">Wishlist Page</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="index-one.html">Home</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">Wishlist Page</li>
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
    <!--=        Wishlist Area Start        =-->
    <!--=====================================-->
    <section class="cart-page-area edu-section-gap">
        <div class="container">
            <div class="table-responsive">
                <table class="table cart-table wishlist-table">
                    <thead>
                    <tr>
                        <th scope="col" class="product-remove">Sno</th>
                        <th scope="col" class="product-thumbnail">Course Name</th>
                        <th scope="col" class="product-thumbnail">Number Of Courses</th>
                        <th scope="col" class="product-title">Total Prices</th>
                        <th scope="col" class="product-price">Purchase Date</th>
                        <th scope="col" class="product-status">Invoice Download</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($purchase_details->result_array() as $his_key => $history) { ?>
                        <tr>
                            <td class="product-remove">
                                <a href="#" class="remove-wishlist"><?php echo $his_key + 1 ?></i></a>
                            </td>
                            <td class="product-title">
                                <a href="#"><?php
                                    $enroll_data = $this->crud_model->get_enroll_by_payment_id($history['payment_id'])->result_array();
                                    foreach ($enroll_data as $key => $enroll_value) {
                                        $course = $this->crud_model->get_course_by_id($enroll_value['course_id'])->result_array();
                                        if (sizeof($enroll_data) > 1) {
                                            if (sizeof($enroll_data) > $key + 1) {
                                                echo $course[0]['title'] . ", ";
                                            } else {
                                                echo $course[0]['title'];
                                            }
                                        } else {
                                            echo $course[0]['title'];
                                        }

                                    }
                                    //                                    echo sizeof($enroll_data);
                                    ?></a>
                            </td>
                            <td class="product-price" data-title="Price">
                                <?php echo sizeof($enroll_data) ?>
                            </td>
                            <td class="product-price" data-title="Price"><span class="currency-symbol">₹</span>
                                <?php echo $history['amount'] ?>
                            </td>
                            <td class="product-status"
                                data-title="Stock"> <?php echo date('M, d Y', strtotime($history['created_at'])) ?></td>
                            <td class="product-add-cart"><a
                                        href="<?php echo base_url('home/purchase_history_form/view_history/' . $history['payment_id']) ?>"
                                        target="_blank" class="edu-btn btn-medium">View Invoice</a>
                            </td>
                        </tr>
                        <?php

//                        print_array($enroll_data);
                    } ?>


                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--=====================================-->
    <!--=        Footer Area Start          =-->
    </div>

    <!--<div class="rn-progress-parent">-->
    <!--    <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">-->
    <!--        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>-->
    <!--    </svg>-->
    <!--</div>-->

<?php

$this->load->view('frontend/default/include/footer');
?>