<?php
$this->load->view('frontend/default/include/header');

?>
<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">My Cart </h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item active" aria-current="page">My Cart </li>
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
<!--=           Cart Area Start         =-->
<!--=====================================-->
<section class="cart-page-area edu-section-gap">
    <div class="container">
        <div class="table-responsive">
            <table class="table cart-table">
                <thead>
                <tr>
                    <th scope="col" class="product-remove">Remove</th>
                    <th scope="col" class="product-thumbnail text-nowrap">Course Thumbnail</th>
                    <th scope="col" class="product-title">Course Name</th>
                    <th scope="col" class="product-price">Price</th>
                    <th scope="col" class="product-price">Discount</th>
                    <th scope="col" class="product-quantity">Gst / 18%</th>
                    <th scope="col" class="product-subtotal">Subtotal</th>
                </tr>
                </thead>
                <tbody>

                <?php
                
                $sub_total = 0;
                $total = 0;
                $cart_item = $this->session->userdata('course_cart');
              
                // print_r($cart_item);die;

                $cart_course_id = explode(',', $cart_item);
                $show = 0;
              
                
                foreach ($cart_course_id as $key => $id) {

                    $course_details = $this->crud_model->get_course_by_id($id)->result_array();  
                          
                    $this->db->where('FIND_IN_SET("'.$id.'",course_id) <>','0')->limit(1)->order_by('id',"DESC");
                    $qw= $this->db->get('ck_webinar')->result_array();
                    $datetime_1=$qw[0]['end_time'];                
                    date_default_timezone_set('Asia/Kolkata'); 
                    $datetime_2 = date("Y-m-d H:i:s"); 
                    $from_time = strtotime($datetime_1); 
                    $to_time = strtotime($datetime_2); 
                    $diff_minutes = round(abs($from_time - $to_time) / 60,2). " minutes";
                    $now_time = date("Y-m-d H:i:s");
                    $offer_start_time = $qw[0]['end_time'];

                    $now_time = strtotime($now_time); 


                    if($qw[0] != ''){

                        $addfirst_offer_time= strtotime($offer_start_time.' + 120 minute');

            
                        $end_time = strtotime($qw[0]['end_time']);

                        if($now_time >= $end_time){

                            if($now_time <= $addfirst_offer_time){
                                // echo 'first 25% off';
                                $dis= $course_details[0]['price']*25/100;
                              

                            }elseif($now_time <= strtotime($offer_start_time.' + 1080 minute')){
                                // echo 'first 20% off';
                                $dis=$course_details[0]['price']*20/100;
                            } else{
                                $dis=0;
                            }
                        }
                    }else{
                        $dis=0;
                    }
                    
                  
                
        
                    foreach ($course_details as $c_details) {
                        $total = $total + $c_details['price']-$dis;
                        $sub_total = $sub_total + $c_details['price'];
                        $show++

                        ?>
                        <tr>
                            <td class="product-remove">
                                <a href="<?php echo base_url('home/cart_form/remove_course/' . $c_details['id']) ?>"
                                   class="remove-wishlist"><i class="icon-73"></i>
                                </a>
                            </td>
                            <td class="product-thumbnail">
                                <a href="<?php echo base_url('home/course/' . rawurlencode(slugify($c_details['title'])) . '/' . $c_details['id']) ?>">
                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($c_details['id']); ?>"
                                         style="border-radius: 10px" alt="Books">
                                </a>
                            </td>
                            <td class="product-title">
                                <a href="<?php echo base_url('home/course/' . rawurlencode(slugify($c_details['title'])) . '/' . $c_details['id']) ?>">
                                    <?php echo $c_details['title'] ?>
                                </a>
                            </td>
                             <?php
                            $m =  $c_details['price'];
                            $gs = $m/100;
                            $gst = $gs*18;
                          
                          
                            ?>
                            <td class="product-price" data-title="Price"><span
                                        class="currency-symbol">₹ </span><?php echo $c_details['price'] ?>
                            </td>
                            <td class="product-subtotal" data-title="Subtotal"><span
                                        class="currency-symbol">₹ </span><?php echo $dis; ?>
                            </td>
                            <td class="product-price" data-title="Price"><span
                                        class="currency-symbol">₹</span> <?php echo $gst;?>
                            </td>
                            
                            <td class="product-subtotal" data-title="Subtotal"><span
                                        class="currency-symbol" >₹ </span><?php echo $c_details['price'] -$dis?>
                            </td>
                        </tr>


                        <?php
                    }

                    if ($show == 0) {
                        ?>
                        <td></td>
                        <td></td>

                        <td style="cursor: pointer; font-size: 20px">
                            <a href="<?php echo base_url('home/cart_form/add_courses') ?>">
                                <b>
                                    Add to Courses .....
                                </b>
                            </a>
                        </td>

                        <td></td>
                        <td></td>

                        <?php
    die;
                    }
                }
                ?>

                </tbody>
            </table>
        </div>

        <div class="cart-update-btn-area">
            <!--            <div class="input-group product-cupon">-->
            <!--                <input placeholder="Coupon code..." type="text">-->
            <!--                <button type="submit" class="submit-btn"><i class="icon-4"></i></button>-->
            <!--            </div>-->
            <!--            <div class="update-btn">-->
            <!--                <a href="#" class="edu-btn btn-border btn-medium disabled">Update Cart <i class="icon-4"></i></a>-->
            <!--            </div>-->
        </div>

        <?php
        if ($show > 0) {
            ?>
            <div class="row">
                <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                    <div class="order-summery">
                        <h4 class="title">Cart Totals</h4>
                        <table class="table summery-table">
                            <tbody>
                            <tr class="order-subtotal">
                                <td>Subtotal</td>
                                <td id="sub_total_money">$210.90</td>
                            </tr>
                            <tr class="order-total">
                                <td>Order Total</td>
                                <td id="total_money">$210.90</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="<?php echo base_url('home/checkout') ?>" class="edu-btn btn-medium checkout-btn">Process
                            to
                            Checkout <i
                                    class="icon-4"></i></a>

                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function () {
        $('#sub_total_money').text("₹" + "<?php echo $sub_total?>");
        $('#total_money').text("₹" + "<?php echo $total?>");
    })
</script>

<?php
$this->load->view('frontend/default/include/footer');
?>
