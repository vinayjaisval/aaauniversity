
<footer class="footer-area d-print-none">
  <div class="container-xl">
    <div class="row">
      <div class="col-md-6">
        <p class="copyright-text">
          <a href=""><img src="<?php echo base_url('uploads/system/'.get_frontend_settings('dark_logo')); ?>" alt="" class="d-inline-block" width="110"></a>
<!--           <a href="<?php echo get_settings('footer_link'); ?>" target="_blank"><?php echo get_settings('footer_text'); ?></a>
 -->        </p>
      </div>
      <div class="col-md-6">
        <ul class="nav justify-content-md-end footer-menu">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('home/about_us'); ?>"><?php echo site_phrase('about'); ?></a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('home/blogdetail'); ?>">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('home/privacy_policy'); ?>"><?php echo site_phrase('privacy_policy'); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('home/terms_and_condition'); ?>"><?php echo site_phrase('terms_and_condition'); ?></a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('home/login'); ?>">
              <?php echo site_phrase('login'); ?>
            </a>
          </li> -->
          <li>
            <select class="language_selector" onchange="switch_language(this.value)">
                <?php
                 $languages = $this->crud_model->get_all_languages();
                 foreach ($languages as $language): ?>
                    <?php if (trim($language) != ""): ?>
                        <option value="<?php echo strtolower($language); ?>" <?php if ($this->session->userdata('language') == $language): ?>selected<?php endif; ?>><?php echo ucwords($language);?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
          </li>
        </ul>
      </div>
    </div>
  </div>




<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/62dfe06237898912e95fbb22/1g8t8919m';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->

  <script type="text/javascript">
    $(document).ready(function(){
    
    $('.items').slick({
  dots: true,
  infinite: true,
  speed: 800,
 autoplay: true,
 autoplaySpeed: 2000,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});
          });
    
  </script>
  <!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+91 8130331768", // WhatsApp number
            call_to_action: "Message us", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
</footer>
<!-- PAYMENT MODAL -->
<!-- Modal -->
<?php
$paypal_info = json_decode(get_settings('paypal'), true);
$stripe_info = json_decode(get_settings('stripe_keys'), true);
if ($paypal_info[0]['active'] == 0) {
  $paypal_status = 'disabled';
}else {
  $paypal_status = '';
}
if ($stripe_info[0]['active'] == 0) {
  $stripe_status = 'disabled';
}else {
  $stripe_status = '';
}
?>
<!--Modal-->
<div class="modal fade multi-step" id="EditRatingModal" tabindex="-1" role="dialog" aria-hidden="true" reset-on-close="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content edit-rating-modal">
      <div class="modal-header">
        <h5 class="modal-title step-1" data-step="1"><?php echo site_phrase('step').' 1'; ?></h5>
        <h5 class="modal-title step-2" data-step="2"><?php echo site_phrase('step').' 2'; ?></h5>
        <h5 class="m-progress-stats modal-title">
          &nbsp;of&nbsp;<span class="m-progress-total"></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="m-progress-bar-wrapper">
        <div class="m-progress-bar">
        </div>
      </div>
      <div class="modal-body step step-1">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="modal-rating-box">
                <h4 class="rating-title"><?php echo site_phrase('how_would_you_rate_this_course_overall'); ?>?</h4>
                <fieldset class="your-rating">
                  <input type="radio" id="star5" name="rating" value="5" />
                  <label class = "full" for="star5"></label>
                  <!-- <input type="radio" id="star4half" name="rating" value="4 and a half" />
                  <label class="half" for="star4half"></label> -->
                  <input type="radio" id="star4" name="rating" value="4" />
                  <label class = "full" for="star4"></label>
                  <!-- <input type="radio" id="star3half" name="rating" value="3 and a half" />
                  <label class="half" for="star3half"></label> -->
                  <input type="radio" id="star3" name="rating" value="3" />
                  <label class = "full" for="star3"></label>
                  <!-- <input type="radio" id="star2half" name="rating" value="2 and a half" />
                  <label class="half" for="star2half"></label> -->
                  <input type="radio" id="star2" name="rating" value="2" />
                  <label class = "full" for="star2"></label>
                  <!-- <input type="radio" id="star1half" name="rating" value="1 and a half" />
                  <label class="half" for="star1half"></label> -->
                  <input type="radio" id="star1" name="rating" value="1" />
                  <label class = "full" for="star1"></label>
                  <!-- <input type="radio" id="starhalf" name="rating" value="half" />
                  <label class="half" for="starhalf"></label> -->
                </fieldset>
              </div>
            </div>
            <div class="col-md-6">
              <div class="modal-course-preview-box">
                <div class="card">
                  <img class="card-img-top img-fluid" id = "course_thumbnail_1" alt="">
                  <div class="card-body">
                    <h5 class="card-title" class = "course_title_for_rating" id = "course_title_1"></h5>
                    <p class="card-text" id = "instructor_details"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body step step-2">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="modal-rating-comment-box">
                <h4 class="rating-title"><?php echo site_phrase('write_a_public_review'); ?></h4>
                <textarea id = "review_of_a_course" name = "review_of_a_course" placeholder="<?php echo site_phrase('describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights').'. '.site_phrase('what_did_the_instructor_do_well_and_what_could_use_some_improvement') ?>?" maxlength="65000" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="modal-course-preview-box">
                <div class="card">
                  <img class="card-img-top img-fluid" id = "course_thumbnail_2" alt="">
                  <div class="card-body">
                    <h5 class="card-title" class = "course_title_for_rating" id = "course_title_2"></h5>
                    <p class="card-text">
                      -
                      <?php
                      $admin_details = $this->user_model->get_admin_details()->row_array();
                      echo $admin_details['first_name'].' '.$admin_details['last_name'];
                      ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="course_id" id = "course_id_for_rating" value="">
      <div class="modal-footer">
        <button type="button" class="btn btn-primary next step step-1" data-step="1" onclick="sendEvent(2)"><?php echo site_phrase('next'); ?></button>
        <button type="button" class="btn btn-primary previous step step-2 mr-auto" data-step="2" onclick="sendEvent(1)"><?php echo site_phrase('previous'); ?></button>
        <button type="button" class="btn btn-primary publish step step-2" onclick="publishRating($('#course_id_for_rating').val())" id = ""><?php echo site_phrase('publish'); ?></button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    function switch_language(language) {
        $.ajax({
            url: '<?php echo site_url('home/site_language'); ?>',
            type: 'post',
            data: {language : language},
            success: function(response) {
                setTimeout(function(){ location.reload(); }, 500);
            }
        });
    }
    $(document).ready(function(){
        
        
      
    });



</script>
