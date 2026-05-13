<?php
$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
$instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
?>
<section class="course-header-area">
  <div class="container">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="course-header-wrap">
          <!--<h1 class="title"><?php echo $course_details['title']; ?></h1>-->

          <h1 class="title">Blog Details</h1>



          <div class="created-row">
            <span class="created-by">
              <?php echo site_phrase('created_by'); ?>
              <a href="<?php echo site_url('home/instructor_page/' . $course_details['user_id']); ?>"><?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?></a>
            </span>
            <?php if ($course_details['last_modified'] > 0) : ?>
              <span class="last-updated-date"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $course_details['last_modified']); ?></span>
            <?php else : ?>
              <span class="last-updated-date"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $course_details['date_added']); ?></span>
            <?php endif; ?>

          </div>
        </div>
      </div>
      <div class="col-lg-4">

      </div>
    </div>
  </div>
</section>
<br>

<section class="course-content-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h3 style="font-weight: 800;">Leaders in business believe computer science should be a required subject in School </h3>

        <img src="https://careercarta.com/wp-content/uploads/2021/02/pexels-hitesh-choudhary-693859-1024x682.jpg" style="width:100%;border-radius: 3px;" />
        <br><br>

        <p style="text-align:justify"> Computer science is becoming an increasingly important subject in today's world. In a recent collection of 500 prominent business, education and non-profit leaders called The Computer Science Curriculum State Action Blueprint, they noted that "computer science is both a technological skill with wide-ranging applicability and an essential component of our broader economic competitiveness." .
          <br>
        <p style="text-align:justify">The leaders provided a list of recommendations to state and local officials who want to ensure that students have the skills to succeed in a workforce that increasingly depends on computers and other technology. While many states have made progress on this initiative, many schools are still only teaching computer science as an optional elective, and the leaders argue that this is not enough to prepare students for the workforce of today and tomorrow. They recommend that all students be required to take at least one course in computer science before graduating high school..</p>
        </p>

        <p style="text-align:justify"> Computer science is a required subject in many high-demand fields, such as engineering and business. Students who are interested in becoming engineers or developing computer programs can take advanced courses to learn specialized skills that are valuable in these fields.
          In business, computer programming is becoming an increasingly important skill for managers and others in the workforce. Without proper training in this area, people are likely to miss out on job opportunities in the future. Studies have shown that a lack of computer skills can lead to lower salaries and less advancement opportunities in the workplace.
          .</p>

        <p style="text-align:justify"> Taking courses in computer science can help people develop the necessary skills to be successful in today's workforce, and it can help them prepare for jobs that are likely to become available in the future. In recent years, interest in computer science has grown tremendously among students and teachers.
          Studies show that the number of students who plan to study computer science in high school is steadily rising, and many universities have begun to offer programs aimed at preparing students for this rapidly growing field. As more students choose to study computer science in college and beyond, the demand for computer scientists will continue to grow. Demand for computer science workers will grow at a faster rate than demand for workers in other fields over the next decade, making it an important field of study for students who wish to pursue careers in computer-related fields.
          .</p>

        <p style="text-align:justify"> Students who choose to pursue a career in computer science can look forward to a number of exciting and rewarding opportunities. The Bureau of Labour Statistics projects that the field of computer science will grow faster than any other profession in the United States over the next ten years. Computer scientists provide vital services to organizations around the world by developing software that helps them run more efficiently and successfully. Many computer scientists go on to work for start-ups and develop innovative new products that have the potential to change the way consumers interact with technology. Information and technology are rapidly changing the world in which we live and the reliance of every aspects of society makes it an important area in which career possibilities are high as the Everest.
        </p>


        <p style="text-align:justify"> Every year, the K-12 Chairman's Initiative, organized by the National Governors Association, brings together governors from all around the nation to collaborate on public policy. The event's subject this year is computer science, and the summer summit's final session starts this week. Asa Hutchinson, the governor of Arkansas who serves as the association's head, is urging governors to make commitments about computer science offers, financing, and assuring diversity and participation in relation to computer science courses. If the letter has the effect Partovi anticipates, it will be a significant step toward making computer science a mandatory subject in school.
        </p>





        <div class="about-instructor-box">
          <div class="about-instructor-title">
            <?php echo site_phrase('about_the_instructor'); ?>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="about-instructor-image">
                <img src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>" alt="" class="img-fluid">
                <ul>
                  <!-- <li><i class="fas fa-star"></i><b>4.4</b> Average Rating</li> -->
                  <li><i class="fas fa-comment"></i><b>
                      <?php echo $this->crud_model->get_instructor_wise_course_ratings($instructor_details['id'], 'course')->num_rows(); ?>
                    </b> <?php echo site_phrase('reviews'); ?></li>
                  <li><i class="fas fa-user"></i><b>
                      <?php
                      $course_ids = $this->crud_model->get_instructor_wise_courses($instructor_details['id'], 'simple_array');
                      $this->db->select('user_id');
                      $this->db->distinct();
                      $this->db->where_in('course_id', $course_ids);
                      echo $this->db->get('enrol')->num_rows();
                      ?>
                    </b> <?php echo site_phrase('students') ?></li>
                  <li><i class="fas fa-play-circle"></i><b>
                      <?php echo $this->crud_model->get_instructor_wise_courses($instructor_details['id'])->num_rows(); ?>
                    </b> <?php echo site_phrase('courses'); ?></li>
                </ul>
              </div>




            </div>
            <div class="col-lg-8">
              <div class="about-instructor-details view-more-parent">
                <div class="view-more" onclick="viewMore(this)">+ <?php echo site_phrase('view_more'); ?></div>
                <div class="instructor-name">
                  <a href="<?php echo site_url('home/instructor_page/' . $course_details['user_id']); ?>"><?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?></a>
                </div>
                <div class="instructor-title">
                  <?php echo $instructor_details['title']; ?>
                </div>
                <div class="instructor-bio">
                  <?php echo $instructor_details['biography']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="student-feedback-box">
          <div class="student-feedback-title">
            <?php echo site_phrase('student_feedback'); ?>
          </div>
          <div class="row">
            <div class="col-lg-3">
              <div class="average-rating">
                <div class="num">
                  <?php
                  $total_rating =  $this->crud_model->get_ratings('course', $course_details['id'], true)->row()->rating;
                  $number_of_ratings = $this->crud_model->get_ratings('course', $course_details['id'])->num_rows();
                  if ($number_of_ratings > 0) {
                    $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                  } else {
                    $average_ceil_rating = 0;
                  }
                  echo $average_ceil_rating;
                  ?>
                </div>
                <div class="rating">
                  <?php for ($i = 1; $i < 6; $i++) : ?>
                    <?php if ($i <= $average_ceil_rating) : ?>
                      <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                    <?php else : ?>
                      <i class="fas fa-star" style="color: #abb0bb;"></i>
                    <?php endif; ?>
                  <?php endfor; ?>
                </div>
                <div class="title"><?php echo site_phrase('average_rating'); ?></div>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="individual-rating">
                <ul>
                  <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <li>
                      <div class="progress">
                        <div class="progress-bar" style="width: <?php echo $this->crud_model->get_percentage_of_specific_rating($i, 'course', $course_id); ?>%"></div>
                      </div>
                      <div>
                        <span class="rating">
                          <?php for ($j = 1; $j <= (5 - $i); $j++) : ?>
                            <i class="fas fa-star"></i>
                          <?php endfor; ?>
                          <?php for ($j = 1; $j <= $i; $j++) : ?>
                            <i class="fas fa-star filled"></i>
                          <?php endfor; ?>

                        </span>
                        <span><?php echo $this->crud_model->get_percentage_of_specific_rating($i, 'course', $course_id); ?>%</span>
                      </div>
                    </li>
                  <?php endfor; ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="reviews">
            <div class="reviews-title"><?php echo site_phrase('reviews'); ?></div>
            <ul>
              <?php
              $ratings = $this->crud_model->get_ratings('course', $course_id)->result_array();
              foreach ($ratings as $rating) :
              ?>
                <li>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="reviewer-details clearfix">
                        <div class="reviewer-img float-left">
                          <img src="<?php echo $this->user_model->get_user_image_url($rating['user_id']); ?>" alt="">
                        </div>
                        <div class="review-time">
                          <div class="time">
                            <?php echo date('D, d-M-Y', $rating['date_added']); ?>
                          </div>
                          <div class="reviewer-name">
                            <?php
                            $user_details = $this->user_model->get_user($rating['user_id'])->row_array();
                            echo $user_details['first_name'] . ' ' . $user_details['last_name'];
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="review-details">
                        <div class="rating">
                          <?php
                          for ($i = 1; $i < 6; $i++) : ?>
                            <?php if ($i <= $rating['rating']) : ?>
                              <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                            <?php else : ?>
                              <i class="fas fa-star" style="color: #abb0bb;"></i>
                            <?php endif; ?>
                          <?php endfor; ?>
                        </div>
                        <div class="review-text">
                          <?php echo $rating['review']; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="course-sidebar natural">
          <?php if ($course_details['video_url'] != "") : ?>
            <div class="preview-video-box">
              <a data-toggle="modal" data-target="#CoursePreviewModal">
                <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="" class="img-fluid">
                <span class="preview-text"><?php echo site_phrase('preview_this_course'); ?></span>
                <span class="play-btn"></span>
              </a>
            </div>
          <?php endif; ?>
          <div class="course-sidebar-text-box">
            <div class="price">
              <?php if ($course_details['is_free_course'] == 1) : ?>
                <span class="current-price"><span class="current-price"><?php echo site_phrase('free'); ?></span></span>
              <?php else : ?>
                <?php if ($course_details['discount_flag'] == 1) : ?>
                  <span class="current-price"><span class="current-price"><?php echo currency($course_details['discounted_price']); ?></span></span>
                  <span class="original-price"><?php echo currency($course_details['price']) ?></span>
                  <input type="hidden" id="total_price_of_checking_out" value="<?php echo currency($course_details['discounted_price']); ?>">
                <?php else : ?>
                  <!--<span class = "current-price"><span class="current-price"><?php echo currency($course_details['price']); ?></span></span>-->
                  <input type="hidden" id="total_price_of_checking_out" value="<?php echo currency($course_details['price']); ?>">
                <?php endif; ?>
              <?php endif; ?>
            </div>

            <?php if (is_purchased($course_details['id'])) : ?>
              <div class="already_purchased">
                <a href="<?php echo site_url('home/my_courses'); ?>"><?php echo site_phrase('already_purchased'); ?></a>
              </div>
            <?php else : ?>

              <!-- WISHLIST BUTTON -->
              <!-- <div class="buy-btns">
                <button class="btn btn-add-wishlist <?php echo $this->crud_model->is_added_to_wishlist($course_details['id']) ? 'active' : ''; ?>" type="button" id="<?php echo $course_details['id']; ?>" onclick="handleAddToWishlist(this)">
                  <?php
                  if ($this->crud_model->is_added_to_wishlist($course_details['id'])) {
                    echo site_phrase('added_to_wishlist');
                  } else {
                    echo site_phrase('add_to_wishlist');
                  }
                  ?>
                </button>
              </div> -->

              <?php if ($course_details['is_free_course'] == 1) : ?>
                <div class="buy-btns">
                  <?php if ($this->session->userdata('user_login') != 1) : ?>
                    <a href="#" class="btn btn-buy-now" onclick="handleEnrolledButton()"><?php echo site_phrase('get_enrolled'); ?></a>
                  <?php else : ?>
                    <a href="<?php echo site_url('home/get_enrolled_to_free_course/' . $course_details['id']); ?>" class="btn btn-buy-now"><?php echo site_phrase('get_enrolled'); ?></a>
                  <?php endif; ?>
                </div>
              <?php else : ?>
                <div class="buy-btns">
                  <!--<a href = "javascript::" class="btn btn-buy-now" id = "course_<?php echo $course_details['id']; ?>" onclick="handleBuyNow(this)"><?php echo site_phrase('buy_now'); ?></a>-->
                  <?php if (in_array($course_details['id'], $this->session->userdata('cart_items'))) : ?>
                    <!--<button class="btn btn-add-cart addedToCart" type="button" id = "<?php echo $course_details['id']; ?>" onclick="handleCartItems(this)"><?php echo site_phrase('added_to_cart'); ?></button>-->

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Enquiry form </button>


                  <?php else : ?>
                    <!--<button class="btn btn-add-cart" type="button" id = "<?php echo $course_details['id']; ?>" onclick="handleCartItems(this)"><?php echo site_phrase('add_to_cart'); ?></button>-->

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Enquiry form </button>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            <?php endif; ?>




            <div class="includes">
              <div class="title"><b><?php echo site_phrase('includes'); ?>:</b></div>
              <ul>
                <?php if ($course_details['course_type'] == 'general') : ?>
                  <li><i class="far fa-file-video"></i>
                    <?php
                    echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']) . ' ' . site_phrase('on_demand_videos');
                    ?>
                  </li>
                  <li><i class="far fa-file"></i><?php echo $this->crud_model->get_lessons('course', $course_details['id'])->num_rows() . ' ' . site_phrase('lessons'); ?></li>
                  <li><i class="fas fa-mobile-alt"></i><?php echo site_phrase('access_on_mobile_and_tv'); ?></li>
                <?php elseif ($course_details['course_type'] == 'scorm') : ?>
                  <li><i class="far fa-file-video"></i><?php echo site_phrase('scorm_course'); ?></li>
                  <li><i class="fas fa-mobile-alt"></i><?php echo site_phrase('access_on_laptop_and_tv'); ?></li>
                <?php endif; ?>
                <li><i class="far fa-compass"></i><?php echo site_phrase('full_lifetime_access'); ?></li>
              </ul>
            </div>

            <form class="inline-form" action="https://ekonacademy.com/home/search" method="get" style="width: 100%;">
              <div class="input-group search-box mobile-search">
                <input type="text" name="query" class="form-control" placeholder="Search for courses">
                <div class="input-group-append">
                  <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>

            <h5> Category: </h5>

            <div class="includes">
              <ul>
                <li> <i class="fas fa-arrow-right"></i> Business leaders think computer science should be a core subject.
                </li>

                <li> <i class="fas fa-arrow-right"></i> Key Differences Between Data Science and Artificial Intelligence.
                </li>

                <li> <i class="fas fa-arrow-right"></i> Types of Artificial Intelligence You Must Know
                </li>

                <li> <i class="fas fa-arrow-right"></i> Top 10 Artificial Intelligence Applications
                </li>
              </ul>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<?php if ($course_details['video_url'] != "") :
  $provider = "";
  $video_details = array();
  if ($course_details['course_overview_provider'] == "html5") {
    $provider = 'html5';
  } else {
    $video_details = $this->video_model->getVideoDetails($course_details['video_url']);
    $provider = $video_details['provider'];
  }
?>
  <div class="modal fade" id="CoursePreviewModal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content course-preview-modal">
        <div class="modal-header">
          <h5 class="modal-title"><span><?php echo site_phrase('course_preview') ?>:</span><?php echo $course_details['title']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" onclick="pausePreview()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="course-preview-video-wrap">
            <div class="embed-responsive embed-responsive-16by9">
              <?php if (strtolower(strtolower($provider)) == 'youtube') : ?>
                <!------------- PLYR.IO ------------>
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/plyr/plyr.css">

                <div class="plyr__video-embed" id="player">
                  <iframe height="500" src="<?php echo $course_details['video_url']; ?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                </div>

                <script src="<?php echo base_url(); ?>assets/global/plyr/plyr.js"></script>
                <script>
                  const player = new Plyr('#player');
                </script>
                <!------------- PLYR.IO ------------>
              <?php elseif (strtolower($provider) == 'vimeo') : ?>
                <!------------- PLYR.IO ------------>
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/plyr/plyr.css">
                <div class="plyr__video-embed" id="player">
                  <iframe height="500" src="https://player.vimeo.com/video/<?php echo $video_details['video_id']; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
                </div>

                <script src="<?php echo base_url(); ?>assets/global/plyr/plyr.js"></script>
                <script>
                  const player = new Plyr('#player');
                </script>
                <!------------- PLYR.IO ------------>
              <?php else : ?>
                <!------------- PLYR.IO ------------>
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/plyr/plyr.css">
                <video poster="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" id="player" playsinline controls>
                  <?php if (get_video_extension($course_details['video_url']) == 'mp4') : ?>
                    <source src="<?php echo $course_details['video_url']; ?>" type="video/mp4">
                  <?php elseif (get_video_extension($course_details['video_url']) == 'webm') : ?>
                    <source src="<?php echo $course_details['video_url']; ?>" type="video/webm">
                  <?php else : ?>
                    <h4><?php site_phrase('video_url_is_not_supported'); ?></h4>
                  <?php endif; ?>
                </video>

                <style media="screen">
                  .plyr__video-wrapper {
                    height: 450px;
                  }
                </style>

                <script src="<?php echo base_url(); ?>assets/global/plyr/plyr.js"></script>
                <script>
                  const player = new Plyr('#player');
                </script>
                <!------------- PLYR.IO ------------>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<!-- Modal -->

<style media="screen">
  .embed-responsive-16by9::before {
    padding-top: 0px;
  }
</style>
<script type="text/javascript">
  function handleCartItems(elem) {
    url1 = '<?php echo site_url('home/handleCartItems'); ?>';
    url2 = '<?php echo site_url('home/refreshWishList'); ?>';
    $.ajax({
      url: url1,
      type: 'POST',
      data: {
        course_id: elem.id
      },
      success: function(response) {
        $('#cart_items').html(response);
        if ($(elem).hasClass('addedToCart')) {
          $(elem).removeClass('addedToCart')
          $(elem).text("<?php echo site_phrase('add_to_cart'); ?>");
        } else {
          $(elem).addClass('addedToCart')
          $(elem).text("<?php echo site_phrase('added_to_cart'); ?>");
        }
        $.ajax({
          url: url2,
          type: 'POST',
          success: function(response) {
            $('#wishlist_items').html(response);
          }
        });
      }
    });
  }

  function handleBuyNow(elem) {

    url1 = '<?php echo site_url('home/handleCartItemForBuyNowButton'); ?>';
    url2 = '<?php echo site_url('home/refreshWishList'); ?>';
    urlToRedirect = '<?php echo site_url('home/shopping_cart'); ?>';
    var explodedArray = elem.id.split("_");
    var course_id = explodedArray[1];

    $.ajax({
      url: url1,
      type: 'POST',
      data: {
        course_id: course_id
      },
      success: function(response) {
        $('#cart_items').html(response);
        $.ajax({
          url: url2,
          type: 'POST',
          success: function(response) {
            $('#wishlist_items').html(response);
            toastr.warning('<?php echo site_phrase('please_wait') . '....'; ?>');
            setTimeout(
              function() {
                window.location.replace(urlToRedirect);
              }, 1500);
          }
        });
      }
    });
  }

  function handleEnrolledButton() {
    $.ajax({
      url: '<?php echo site_url('home/isLoggedIn'); ?>',
      success: function(response) {
        if (!response) {
          window.location.replace("<?php echo site_url('login'); ?>");
        }
      }
    });
  }

  function handleAddToWishlist(elem) {
    $.ajax({
      url: '<?php echo site_url('home/handleWishList'); ?>',
      type: 'POST',
      data: {
        course_id: elem.id
      },
      success: function(response) {
        if (!response) {
          window.location.replace("<?php echo site_url('login'); ?>");
        } else {
          if ($(elem).hasClass('active')) {
            $(elem).removeClass('active');
            $(elem).text("<?php echo site_phrase('add_to_wishlist'); ?>");
          } else {
            $(elem).addClass('active');
            $(elem).text("<?php echo site_phrase('added_to_wishlist'); ?>");
          }
          $('#wishlist_items').html(response);
        }
      }
    });
  }

  function pausePreview() {
    player.pause();
  }
</script>