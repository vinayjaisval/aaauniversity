<?php $this->load->view('frontend/default/include/header'); ?>

<style>
    .bg-image--19 {
        opacity: 0.7;
        background-image: url('<?php echo base_url(); ?>uploads/blog/banner/<?php echo $blog_details[0]['banner'] ?>');
    }

    .border_top {
        margin-left: 110px;
        border-top: 1px solid #e5e5e5;
        padding-top: 30px;
        margin-top: 30px;

    }
</style>

<div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Blog Details</h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>

                <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
            </ul>
        </div>
    </div>
</div>

<!--=====================================-->
<!--=       Blog Details Area Start     =-->
<!--=====================================-->
<div class="blog-details-area section-gap-equal">
    <div class="container">
        <div class="row row--30">
            <div class="col-lg-8">
                <div class="blog-details-content">
                    <div class="entry-content">
                        <span class="category">
                            <?php
                            $data = $this->crud_model->get_by_id_and_slug_blog_category($blog_details[0]['blog_category_id'])->result_array();
                            echo $data[0]['title'];

                            ?>
                        </span>
                        <h3 class="title"><?php echo $blog_details[0]['title'] ?></h3>
                        <ul class="blog-meta">
                            <li><i class="icon-27"></i>
                                <?php echo date('M d, Y', strtotime($blog_details[0]['created_at'])) ?>
                            </li>
                            <li><i class="icon-28"></i>Com 09</li>
                        </ul>
                        <div class="thumbnail">
                            <img src="<?php echo base_url('uploads/blog/content_image/' . $blog_details[0]['content_image']) ?>"
                                 alt="Blog Image">
                        </div>

                        <div class="description">

                            <?php echo $blog_details[0]['description'] ?>


                        </div>
                    </div>

                    <div class="blog-share-area">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <!--                                <div class="blog-tags">-->
                                <!--                                    <h6 class="title">Tags:</h6>-->
                                <!--                                    <div class="tag-list">-->
                                <!--                                        <a href="#">Language</a>-->
                                <!--                                        <a href="#">eLearn</a>-->
                                <!--                                        <a href="#">Tips</a>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                            </div>
                            <div class="col-md-5">
                                <div class="blog-share">
                                    <h6 class="title">Share on:</h6>
                                    <ul class="social-share icon-transparent">
                                        <li>
                                            <a href="#"><i class="icon-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="blog-author">
                    <div class="thumbnail">
                        <?php
                        $author = $this->user_model->get_user_id($blog_details[0]['user_id'])->result_array();
                        //                         print_r($author);
                        //                         $this->get
                        ?>
                        <img src="<?php echo $this->user_model->get_user_image_url($blog_details[0]['user_id']) ?>"
                             alt="Author Images" style="width: 100px">
                    </div>
                    <div class="author-content">
                        <h5 class="title"><?php echo $author[0]['first_name'] . " " . $author[0]['last_name'] ?></h5>
                        <p><?php echo $author[0]['biography	']; ?></p>
                        <?php
                        $dats = json_decode($author[0]['social_links'], true);
                        ?>
                        <ul class="social-share icon-transparent">
                            <li><a href="<?php echo $dats['facebook'] ?>" target="_blank"><i
                                            class="icon-facebook"></i></a></li>
                            <li><a href="<?php echo $dats['twitter'] ?>" target="_blank"><i
                                            class="icon-twitter"></i></a></li>
                            <li><a href="<?php echo $dats['linkedin'] ?>" target="_blank"><i
                                            class="icon-linkedin2"></i></a>
                            </li>

                        </ul>
                    </div>
                </div>

                <!-- Start Comment Area  -->
                <div class="comment-area">
                    <?php
                    $num = $blog_comments->num_rows();
                    if ($num > 0):
                        ?>
                        <h3 class="heading-title">Comments</h3>
                        <div class="comment-list-wrapper">
                            <!-- Start Single Comment  -->
                            <?php
                            foreach ($blog_comments->result_array() as $key => $blog_comment):
                                $comment_er = $this->user_model->get_all_user($blog_comment['user_id'])->result_array();
                                if ($key < 3): ?>
                                    <div class="comment">
                                        <div class="thumbnail">
                                            <img src="<?php echo $this->user_model->get_user_image_url($comment_er[0]['id']); ?>"
                                                 alt="Comment Images" style="border-radius: 50%">
                                        </div>
                                        <div class="comment-content">
                                            <h5 class="title">
                                                <?php echo $comment_er[0]['first_name'] . " " . $comment_er[0]['last_name'] ?>
                                            </h5>
                                            <span class="date">
                                        <?php echo date("M d,Y", strtotime($blog_comment['created_at'])) ?>
                                    </span>
                                            <p>
                                                <?php echo $blog_comment['comment_text'] ?>
                                            </p>
                                            <div class="reply-btn-wrapper">
                                            <span class="reply-btn " id="reply_button<?php echo $blog_comment['id'] ?>"
                                                  onclick="reply_button()" style="cursor:pointer;">Reply</span>
                                                <form method="post"
                                                      action="<?php echo base_url('home/comment_form/reply_comment') ?>"
                                                      id="replyform<?php echo $blog_comment['id'] ?>"
                                                      class="form-control ">

                                                    <div class="form-group col-lg-6" hidden>
                                                        <input type="text" name="blog_id" id="comm-name"
                                                               value="<?php echo $blog_details[0]['id'] ?>">
                                                    </div>
                                                    <div class="form-group col-lg-6" hidden>
                                                        <input type="text" name="blog_comment_id" id="comm-name"
                                                               value="<?php echo $blog_comment['id'] ?>">
                                                    </div>
                                                    <div class="form-group col-12">
                                                <textarea name="reply_text" id="comm-message" cols="30" rows="2"
                                                          placeholder="Leave A Reply...."
                                                          style="border: solid 1px #b5b7b4"></textarea>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <button type="submit" class="edu-btn submit-btn">
                                                            Send Message <i class="icon-4"></i>
                                                        </button>
                                                    </div>
                                                </form>

                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                                                <script type="text/javascript">

                                                    $(document).ready(function () {
                                                        $("#replyform<?php echo $blog_comment['id']?>").hide()
                                                    });
                                                    $("#reply_button<?php echo $blog_comment['id']?>").click(function () {
                                                        $("#replyform<?php echo $blog_comment['id']?>").toggle("medium");
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                $reply = $this->crud_model->get_blog_reply_by_comment_id($blog_comment['id']);
                                $comment_reply = $reply->result_array();
                                $reply_nums = $reply->num_rows();

                                if ($reply_nums > 0): ?>
                                    <div id="befor_reply<?php echo $blog_comment['id'] ?>"
                                         class="comment comment-reply">
                                        <div class="thumbnail">
                                            <?php
                                            $reply_er = $this->user_model->get_all_user($comment_reply[0]['user_id'])->result_array();
                                            ?>
                                            <img src="<?php echo $this->user_model->get_user_image_url($comment_reply[0]['user_id']) ?>"
                                                 alt="Author Images" style="width: 100px"></div>
                                        <div class="comment-content">
                                            <h5 class="title"><?php echo $reply_er[0]['first_name'] . " " . $reply_er[0]['last_name'] ?></h5>
                                            <span class="date"><?php echo date('M d, Y', strtotime($comment_reply[0]['created_at'])) ?></span>
                                            <p>
                                                <?php echo $comment_reply[0]['reply_text'] ?>
                                            </p>
                                            <div class="reply-btn-wrapper">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 20px; "
                                         id="reply_text<?php echo $blog_comment['id'] ?>"></div>
                                <?php endif;
                                if ($reply_nums > 1):
                                ?>
                                    <p class="comment comment-reply"
                                       id="view_all_text1-<?php echo $blog_comment['id'] ?>"
                                       style="cursor: pointer">View All</p>

                                    <script type="text/javascript">
                                        //$(document).ready(function (){
                                        //    var _sa = $('#view_all_text<?php //echo $blog_comment['id']?>//')
                                        //    console.log(_sa);
                                        //})

                                        $('#view_all_text1-<?php echo $blog_comment['id']?>').click(function () {
                                            $(this).text()
                                            if ($(this).text() === "View All") {
                                                $(this).text("Close Reply")
                                                $('#befor_reply<?php echo $blog_comment['id']?>').hide()

                                                $.ajax({
                                                    url: '<?php echo base_url("admin/blog_form/view_all/" . $blog_comment['id']);?>',
                                                    dataType: 'json',
                                                    success: function (data) {
                                                        for (let key in data) {

                                                            let d = data[key]['created_at']
                                                            let date = d.split('-')
                                                            let month = date[1];
                                                            let year = date[0]
                                                            let day = date[2].split(" ")[0]

                                                            var reply_text = ` <div class="comment comment-reply">
                                                                             <div id="image${data[key]['id']}" class="thumbnail">
                                                                             </div>
                                                                             <div class="comment-content">
                                                                             <h5 id='name${data[key]['id']}' class="title"></h5>
                                                                             <span class="date">${month} / ${day} / ${year}</span>
                                                                             <p>${data[key]['reply_text']}</p>
                                                                             <div class="reply-btn-wrapper"></div>
                                                                             </div>
                                                                             </div>`

                                                            $('#reply_text<?php echo $blog_comment['id']?>').append(reply_text);


                                                            $.ajax({
                                                                url: '<?php echo base_url("admin/blog_form/view_user/");?>' + data[key]['user_id'],
                                                                dataType: 'json',
                                                                success: function (data1) {
                                                                    var name = data1[0]['first_name'] + " " + data1[0]['last_name'];
                                                                    $("#name" + data[key]['id']).text(name);
                                                                }
                                                            });

                                                            $.ajax({
                                                                url: '<?php echo base_url("admin/blog_form/user_image/");?>' + data[key]['user_id'],
                                                                dataType: 'json',
                                                                success: function (data2) {
                                                                    var image = '<img src="' + data2 + '" alt="Author Images" style="width: 100px">'

                                                                    console.log(data2);
                                                                    $("#image" + data[key]['id']).append(image);
                                                                }
                                                            });

                                                            //<img src="<?php //echo $this->user_model->get_user_image_url($comment_reply[0]['user_id']) ?><!--<!--" alt="Author Images" style="width: 100px">-->-->

                                                        }
                                                    }
                                                })

                                            } else if ($(this).text() === "Close Reply") {
                                                $('#reply_text<?php echo $blog_comment['id']?>').hide()
                                                $(this).text("View reply")
                                                $('#befor_reply<?php echo $blog_comment['id']?>').show()

                                            } else if ($(this).text() === "View reply") {
                                                $(this).text("Close Reply")
                                                $('#befor_reply<?php echo $blog_comment['id']?>').hide()
                                                $('#reply_text<?php echo $blog_comment['id']?>').show()
                                            }
                                        })

                                    </script>

                                <?php endif; ?>

                                <?php else:
                                $count++ ?>
                                    <div class="show_comment"
                                         style=" border-top: 1px solid var(--color-border);padding-top: 30px;margin-top: 30px;">
                                        <div class="comment">
                                            <div class="thumbnail">
                                                <img src="<?php echo $this->user_model->get_user_image_url($comment_er[0]['id']) ?>"
                                                     alt="Comment Images" style="border-radius: 50%">
                                            </div>
                                            <div class="comment-content">
                                                <h5 class="title">
                                                    <?php echo $comment_er[0]['first_name'] . " " . $comment_er[0]['last_name'] ?>
                                                </h5>
                                                <span class="date">
                                                    <?php echo date("M d,Y", strtotime($blog_comment['created_at'])) ?>
                                                </span>
                                                <p>
                                                    <?php echo $blog_comment['comment_text'] ?>
                                                </p>

                                                <div class="reply-btn-wrapper">
                                                <span class="reply-btn "
                                                      id="reply_button<?php echo $blog_comment['id'] ?>"
                                                      onclick="reply_button()" style="cursor:pointer;">Reply</span>
                                                    <form method="post"
                                                          action="<?php echo base_url('home/comment_form/reply_comment') ?>"
                                                          id="replyform<?php echo $blog_comment['id'] ?>"
                                                          class="form-control ">

                                                        <div class="form-group col-lg-6" hidden>
                                                            <input type="text" name="blog_id" id="comm-name"
                                                                   value="<?php echo $blog_details[0]['id'] ?>">
                                                        </div>
                                                        <div class="form-group col-lg-6" hidden>
                                                            <input type="text" name="blog_comment_id" id="comm-name"
                                                                   value="<?php echo $blog_comment['id'] ?>">
                                                        </div>
                                                        <div class="form-group col-12">
                                                        <textarea name="reply_text" id="comm-message" cols="30" rows="2"
                                                                  placeholder="Leave A Reply...."
                                                                  style="border: solid 1px #b5b7b4">
                                                        </textarea>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <button type="submit" class="edu-btn submit-btn">
                                                                Send Message <i class="icon-4"></i>
                                                            </button>
                                                        </div>
                                                    </form>

                                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                                                    <script type="text/javascript">

                                                        $(document).ready(function () {
                                                            $("#replyform<?php echo $blog_comment['id']?>").hide()
                                                        });
                                                        $("#reply_button<?php echo $blog_comment['id']?>").click(function () {
                                                            $("#replyform<?php echo $blog_comment['id']?>").toggle("medium");
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $reply = $this->crud_model->get_blog_reply_by_comment_id($blog_comment['id']);
                                        $comment_reply = $reply->result_array();
                                        $reply_nums = $reply->num_rows();

                                        if ($reply_nums > 0): ?>
                                            <div id="befor_reply1<?php echo $blog_comment['id'] ?>"
                                                 class="comment comment-reply">
                                                <div class="thumbnail">
                                                    <?php
                                                    $reply_er = $this->user_model->get_all_user($comment_reply[0]['user_id'])->result_array();
                                                    ?>
                                                    <img src="<?php echo $this->user_model->get_user_image_url($comment_reply[0]['user_id']) ?>"
                                                         alt="Author Images" style="width: 100px"></div>
                                                <div class="comment-content">
                                                    <h5 class="title"><?php echo $reply_er[0]['first_name'] . " " . $reply_er[0]['last_name'] ?></h5>
                                                    <span class="date"><?php echo date('M d, Y', strtotime($comment_reply[0]['created_at'])) ?></span>
                                                    <p>
                                                        <?php echo $comment_reply[0]['reply_text'] ?>
                                                    </p>
                                                    <div class="reply-btn-wrapper">
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top: 20px; "
                                                 id="reply_text<?php echo $blog_comment['id'] ?>"></div>
                                        <?php endif;
                                        if ($reply_nums > 1):
                                            ?>
                                            <p class="comment comment-reply"
                                               id="view_all_text-<?php echo $blog_comment['id'] ?>"
                                               style="cursor: pointer">View All</p>

                                            <script type="text/javascript">
                                                //$(document).ready(function (){
                                                //    var _sa = $('#view_all_text<?php //echo $blog_comment['id']?>//')
                                                //    console.log(_sa);
                                                //})
                                                $('#view_all_text-<?php echo $blog_comment['id']?>').click(function () {
                                                    $(this).text()
                                                    if ($(this).text() === "View All") {
                                                        $(this).text("Close Reply")
                                                        $('#befor_reply1<?php echo $blog_comment['id']?>').hide()

                                                        $.ajax({
                                                            url: '<?php echo base_url("admin/blog_form/view_all/" . $blog_comment['id']);?>',
                                                            dataType: 'json',
                                                            success: function (data) {
                                                                for (let key in data) {

                                                                    let d = data[key]['created_at']
                                                                    let date = d.split('-')
                                                                    let month = date[1];
                                                                    let year = date[0]
                                                                    let day = date[2].split(" ")[0]

                                                                    //var reply_text = ` <div class="comment comment-reply">
                                                                    //        <div class="thumbnail">
                                                                    //        <img src="<?php //echo $this->user_model->get_user_image_url($comment_reply[0]['user_id']) ?>//" alt="Author Images" style="width: 100px">
                                                                    //        </div>
                                                                    //        <div class="comment-content">
                                                                    //        <h5 id='name${key}' class="title"></h5>
                                                                    //        <span class="date">${month} / ${day} / ${year}</span>
                                                                    //        <p>${data[key]['reply_text']}</p>
                                                                    //        <div class="reply-btn-wrapper"></div>
                                                                    //         </div>
                                                                    //         </div>`

                                                                    var reply_text = ` <div class="comment comment-reply">
                                                                             <div id="image${data[key]['id']}" class="thumbnail">
                                                                             </div>
                                                                             <div class="comment-content">
                                                                             <h5 id='name${data[key]['id']}' class="title"></h5>
                                                                             <span class="date">${month} / ${day} / ${year}</span>
                                                                             <p>${data[key]['reply_text']}</p>
                                                                             <div class="reply-btn-wrapper"></div>
                                                                             </div>
                                                                             </div>`

                                                                    $('#reply_text<?php echo $blog_comment['id']?>').append(reply_text);

                                                                    $.ajax({
                                                                        url: '<?php echo base_url("admin/blog_form/view_user/");?>' + data[key]['user_id'],
                                                                        dataType: 'json',
                                                                        success: function (data1) {
                                                                            var name = data1[0]['first_name'] + " " + data1[0]['last_name'];
                                                                            $("#name" + data[key]['id']).text(name);
                                                                        }
                                                                    });

                                                                    $.ajax({
                                                                        url: '<?php echo base_url("admin/blog_form/user_image/");?>' + data[key]['user_id'],
                                                                        dataType: 'json',
                                                                        success: function (data2) {
                                                                            var image = '<img src="' + data2 + '" alt="Author Images" style="width: 100px">'

                                                                            console.log(data2);
                                                                            $("#image" + data[key]['id']).append(image);
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                        })

                                                    } else if ($(this).text() === "Close Reply") {
                                                        $('#reply_text<?php echo $blog_comment['id']?>').hide()
                                                        $(this).text("View reply")
                                                        $('#befor_reply1<?php echo $blog_comment['id']?>').show()

                                                    } else if ($(this).text() === "View reply") {
                                                        $(this).text("Close Reply")
                                                        $('#befor_reply1<?php echo $blog_comment['id']?>').hide()
                                                        $('#reply_text<?php echo $blog_comment['id']?>').show()
                                                    }
                                                })

                                            </script>

                                        <?php endif; ?>
                                    </div>

                                <?php endif; endforeach;
                            if ($count > 0): ?>

                                <p class="show_comment_btn" id="view_all_text"
                                   style="cursor: pointer; padding-top: 10px">View All Comment</p>
                            <?php endif; ?>
                            <script type="text/javascript">

                                $(document).ready(function () {
                                    $('.show_comment').hide()
                                })
                                $('.show_comment_btn').click(function () {
                                    if ($(this).text() === "View All Comment") {
                                        $(this).text("Close Comment");
                                    } else if ($(this).text() === "Close Comment") {
                                        $(this).text("View All Comment");

                                    }
                                    $('.show_comment').toggle("medium")

                                })
                            </script>
                        </div>
                    <?php endif; ?>
                    <!-- End view all Comment Code -->
                </div>

                <!-- End Comment Area  -->


                <div class="comment-form-area">
                    <h3 class="heading-title">Leave Your Comment Here</h3>
                    <form class="comment-form" action="<?php echo base_url('home/comment_form/add') ?>" method="post">
                        <div class="row g-5">
                            <div class="form-group col-lg-6" hidden>
                                <input type="text" name="blog_id" id="comm-name"
                                       value="<?php echo $blog_details[0]['id'] ?>" placeholder="Your Name*">
                            </div>
                            <div class="form-group col-12">
                                <textarea name="comment" id="comm-message" cols="30" rows="5"
                                          placeholder="Write A Comment...."></textarea>
                            </div>
                            <!--                            <div class="form-group">-->
                            <!--                                <div class="edu-form-check">-->
                            <!--                                    <input type="checkbox" id="save-info">-->
                            <!--                                    <label for="save-info">Save my name, email, and website in this browser for the next-->
                            <!--                                        time I comment.</label>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="form-group col-12">
                                <button type="submit" class="edu-btn submit-btn">Send Message <i class="icon-4"></i>
                                </button>
                            </div>
                        </div>
                    </form>
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
                                    <input type="search" name="query" placeholder="Search courses...">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->

                    <!-- Start Single Widget  -->
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

                                                <i class="<?php echo $category['font_awesome_class'] ?>"
                                                   aria-hidden="true"></i>

                                                &nbsp; <?php echo $category['name']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->

                    <!-- Start Single Widget  -->
                    <div class="edu-blog-widget widget-tags">
                        <div class="inner">
                            <h4 class="widget-title">Tags</h4>
                            <div class="content">
                                <div class="tag-list">
                                    <a href="#">Language</a>
                                    <a href="#">eLearn</a>
                                    <a href="#">Tips</a>
                                    <a href="#">Course</a>
                                    <a href="#">Motivation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--=====================================-->
<!--=        CTA  Area Start            =-->
<!--=====================================-->
<!-- Start Ad Banner Area -->
<!-- End Ad Banner Area  -->
<!--=====================================-->
<!--=        Footer Area Start       	=-->
<!--=====================================-->
<!-- Start Footer Area  -->


<?php $this->load->view('frontend/default/include/footer'); ?>
