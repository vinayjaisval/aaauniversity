<?php $this->load->view('frontend/default/include/header'); ?>

<style>
   
    .border_top {
        margin-left: 110px;
        border-top: 1px solid #e5e5e5;
        padding-top: 30px;
        margin-top: 30px;

    }
    .webinarTTL88 {
    background: #fff;
    color: #00266C;
    padding: 15px;
    font-size: 18px;
    display: block;
    margin-top: 35px;
    border-radius: 10px 10px 0px 0px;
}
.edu-breadcrumb{ padding-bottom:45px !important;}
.webinarRightSide {
  box-sizing: border-box;
  padding: 20px 30px;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;
}
@media (max-width:767px){
  .edu-breadcrumb{ padding-bottom:0px !important;}

}


.webinarSetion1 img{ height:90px; width:90px; border-radius:90px; border:1px solid #E1E1E1; padding:5px; }
  .webinarSetion1{ margin-bottom:20px; padding-bottom:15px;}
  .border-bottom1{ border-bottom:1px solid #E1E1E1;}
  .webinarSetion2-inner{ box-sizing:border-box; padding:15px; padding-bottom:7px; box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 0px inset;}
.theme-text88{
  color:#00266c;
}
</style>

<div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title mb-0">Webinar Details</h1>
            </div>
            <ul class="edu-breadcrumb edu-breadcrumb88 ">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>

                <li class="breadcrumb-item active" aria-current="page">Webinar Details</li>
            </ul>
        </div>
        <!-- <h1 class="title mblfxpsn88 text-left position-absolute mb-0 bottom-0">
        <span class="webinarTTL88"> </span>
      </h1> -->
    </div>
</div>​
<div class="webinarTextContainer">
  <div class="container">
    <div class="webinarTextContainer_Inner">
      <div class="row">
        <div class="col-md-8">
        <div class="webinarSetion1">
              <div class="d-flex justify-content-between">
                <div>
                  <h3 class="mb-0"><?php echo ($webinar_details[0]['title']) ?></h3>
                 
                </div>
                
              </div>
            </div>
              <div class="event_img">
                <img src=" <?= base_url() . 'uploads/webinar/' .$webinar_details[0]['image']?>" alt="event"  />
              
              </div>
                      
                      <!-- <h3>In this Webinar you'll learn...</h3> -->        
       
           
            <div class="webinarSetion2 mt-3">
            <!-- <h3>What you'll do</h3> -->
            <!-- <div class="webinarSetion2-inner"> -->
            <!-- <div class="d-flex border-bottom1 pb-2 mb-3"> -->
                <!-- <span class="theme-text88">10M</span>
                <span class="ms-3">Friendly Interaction</span> -->
              <!-- </div> -->
              <!-- <div class="d-flex border-bottom1 pb-2 mb-3"> -->
                <!-- <span class="theme-text88">40M</span>
                <span class="ms-3">Lesson</span> -->
              <!-- </div> -->
              <!-- <div class="d-flex"> -->
                <!-- <span class="theme-text88">10M</span>
                <span class="ms-3">Review & Sum Up</span> -->
              <!-- </div> -->
            <!-- </div> -->
          </div>


          <p class="mt-5">   <span class="ms-3"> <?php echo $webinar_details[0]['short_dis'] ?></span></p>

                      
        </div> 
​
        <div class="col-md-4">
          <div class="webinarRightSide">
              
           
                <div class="row">
                <a href="" class=" mt-3 btn-gradient text-white edu-btn btn-medium btn-gradient">  Webinar Details</a>
              </div>
              <div class="row mt-3">

              <div class="col-12">
              <p class="mb-0 theme-icon-color"><b>Online Lesson by:</b> <span>Mrs. Sarika Mathur</span></p>
              </div>
                <div class="col-6">
                
                  <!-- <i class="fa-solid fa-calendar-days"></i> -->
                  
                  <p class="d-flex align-items-center my-3 mb-0">
                  <span><b>Date</b></span>
                  <?php
                  $dt= $webinar_details[0]['start_time'];
                // Convert datetime to Unix timestamp
$timestamp = strtotime($dt);

// Subtract time from datetime
$time = $timestamp - 30;

// Date and time after subtraction
$datetime = date("H:i:s", $time);
$endt= $webinar_details[0]['end_time'];
// Convert datetime to Unix timestamp
$endtime = strtotime($endt);

// Subtract time from datetime
$etime = $endtime - 30;

// Date and time after subtraction
$et = date("H:i:s", $etime);

               
                  ?>
                  <span class="ms-3"><?php echo date("Y-m-d", strtotime($dt))?></span>
                  
                  </p>
                  <p class="d-flex align-items-center my-3 mb-0">
                  <span><b>Start Time</b></span>
                  <span class="ms-3"><?php echo $datetime ?></span>
                  </p>
                  <p class="d-flex align-items-center my-3 mb-0">
                  <span><b>Staus</b></span>
                  <span class="ms-3"><?php echo $webinar_details[0]['web_status'] ?></span>
                  </p> 
                </div>
                <div class="col-6">
                               
                  ​<p class="d-flex align-items-center mb-0" style="margin-top:19px">
                  <span><b>End Time</b></span>
                  <span class="ms-3"><?php echo $et ?></span>
                  </p> 
                </div>
                <p class="d-flex align-items-center my-3 mb-0">
                  <span><a href="<?php echo $webinar_details[0]['recording_link'] ?>"><b>Webinar Recording</b></a></span>
                  
                  </p>
              </div>
​          </div><!--end of webinarRightSide-->
        </div> 
        
    </div>
​
    
  </div><!--end of webinarTextContainer_Inner-->
  </div>
</div><!--end of webinarTextContainer-->



<?php $this->load->view('frontend/default/include/footer'); ?>
