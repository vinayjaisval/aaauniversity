<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('view_course_review'); ?>
                    <!--                    <a href="-->
                    <?php //echo site_url('admin/blog_form/add_form'); ?><!--" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i>-->
                    <?php //echo get_phrase('add_new_blog'); ?><!--</a>-->
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 style="color: #719ecb">
                    <?php echo $course_review['title'] ?>
                </h4>

                <div>
                    <div class="comment" style="margin-top: 20px">
                        <h5>Review On This Courses</h5>
                    </div>

                    <?php
//                    all_number_of_ratings_by_course_id
                    $reviews = $this->crud_model->all_number_of_ratings_by_course_id($course_review['id'],'','admin');

                    if ($reviews->num_rows() > 0) {

                    foreach ($reviews->result_array() as $review) {
                        ?>

                        <div class="row col-md-12" style="margin-top: 30px; margin">
                            <div class="col-md-1">
                                <img src="<?php echo base_url('uploads/user_image/placeholder.png') ?>" height="50px">
                            </div>
                            <div style="" class="col-md-8 top-0">
                                <h5 style="line-height: 0">
                                    <?php

                                    $review_er = $this->user_model->get_all_user($review['user_id'])->result_array();

                                    echo $review_er[0]['first_name'] . " " . $review_er[0]['last_name'];

                                    ?>

                                    ( <small><?php echo date("M d,Y", strtotime($review['date_added'])); ?></small> )
                                </h5>
                                <?php echo $review['review'] ?>


                                <!-- Start Reply Comment-->

                                <div id="reply-<?php echo $review['id'] ?>" class="reply">

                                    <?php
                                    $reply = $this->crud_model->get_reviews_reply($review['id'],'admin');
                                    //                                print_r($reply->result_array());
                                    foreach ($reply->result_array() as $reply_list):
                                        ?>

                                        <div class="row"
                                             style="border-top: #666666 1px solid; margin-top: 20px; padding-top: 20px; padding-bottom: 10px;">
                                            <div class="col-md-1">
                                                <img src="<?php echo base_url('uploads/user_image/placeholder.png') ?>"
                                                     height="50px">
                                            </div>
                                            <div style="padding-left: 20px" class="col-md-8 top-0">
                                                <h5 style="line-height: 0">
                                                    <?php
                                                    $review_er = $this->user_model->get_all_user($reply_list['user_id'])->result_array();
                                                    echo $review_er[0]['first_name'] . " " . $review_er[0]['last_name'];
                                                    ?>

                                                    (<small><?php echo $reply_list['created_at'] ?></small>)
                                                </h5>
                                                <?php echo $reply_list['review_reply'] ?>
                                            </div>
                                            <div class="col-md-2">
                                                <b>status :- </b>
                                                <?php
                                                if ($reply_list['status'] == "1"):
                                                    echo "<span style='color: #7dee7d' id='status_view_" . $reply_list['id'] . "'>Enable</span>";
                                                else:
                                                    echo "<span style='color: #f48181' id='status_view_" . $reply_list['id'] . "'>Disable</span>";

                                                endif;
                                                ?>

                                            </div>
                                            <div class="col-md-1">
                                                <div class="dropdown show">
                                                    <a class="btn btn-icon btn-outline-secondary btn-sm" href="#"
                                                       role="button"
                                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <span class="dropdown-item" style="cursor: pointer"
                                                              id="status_<?php echo $reply_list['id'] ?>">Status</span>
                                                    </div>
                                                </div>
                                                <!--                                <span class="btn-outline-success" style="margin-block-end: auto">-->
                                                <!--                                    <i class="mdi mdi-more"></i> </span>-->
                                            </div>
                                        </div>

                                        <script>

                                            $("#status_<?php echo $reply_list['id']?>").click(function () {
                                                $.ajax({
                                                    url: '<?php echo base_url('admin/course_review_form/review_reply_status/' . $reply_list['id']) ?>',
                                                    success: function (response) {
                                                        if (response === '1') {
                                                            $("#status_view_<?php echo $reply_list['id']?>").text("Enable")
                                                            $("#status_view_<?php echo $reply_list['id']?>").css('color', '#7dee7d')
                                                        } else if (response === '0') {
                                                            $("#status_view_<?php echo $reply_list['id']?>").text("Disable");
                                                            $("#status_view_<?php echo $reply_list['id']?>").css('color', '#f48181')
                                                        }
                                                    },
                                                    error: function (data) {
                                                        console.log("error")
                                                        console.log(data)
                                                    }
                                                });
                                            });
                                        </script>

                                    <?php endforeach; ?>
                                </div>

                                <!-- End Reply Comment-->
                            </div>
                            <div class="col-md-2">
                                <b>status :- </b>
                                <?php
                                if ($review['status'] == "1"):
//                                    echo "<span style='color: #f48181'> Disable</span>";

                                    echo "<span style='color: #7dee7d'> Enable</span>";
                                else:
//                                    echo "<span style='color: #7dee7d'> Enable</span>";

                                    echo "<span style='color: #f48181'> Disable</span>";
                                endif;
                                ?>

                            </div>
                            <div class="col-md-1">
                                <div class="dropdown show">
                                    <a class="btn btn-icon btn-outline-secondary btn-sm" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <?php
                                        if ($review['status'] == "1"):
                                            echo "<a href='" . base_url('admin/course_review_form/status/' . $review['id']) . "' class='dropdown-item'>Status Disable</a>";
                                        else:
                                            echo "<a href='" . base_url('admin/course_review_form/status/' . $review['id']) . "' class='dropdown-item'>Status Enable</a>";
                                        endif;

                                        if ($reply->num_rows() > 0):
                                            echo "<sapn id='view_reply_" . $review['id'] . "' class='dropdown-item' style='cursor:pointer'>View Reply</sapn>";
                                        endif;

                                        ?>
                                        <a class="dropdown-item" href="javascript::" onclick="confirm_modal('<?php echo base_url('admin/course_review_form/delete_review/'.$review['id'])?>')"
                                           >Delete Review</a>


                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-12"
                             style="border-bottom: #666666 1px solid; padding-bottom: 10px; margin-left:15px; padding-right:15px">
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('.reply').hide();
                            })

                            $("#<?php echo 'view_reply_' . $review['id']?>").click(function () {
                                $("#reply-<?php echo $review['id']?>").toggle('medium');

                                if ($(this).text() === "View Reply") {
                                    $(this).text("Close Reply")
                                } else if ($(this).text() === "Close Reply") {
                                    $(this).text("View Reply")
                                }
                            })
                        </script>


                    <?php }
                    }else{ ?>

                        <div class="comment" style="margin-top: 20px; text-align: center">
                            <h5>No Comment On This Blog....</h5>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
