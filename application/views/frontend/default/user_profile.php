<?php
$this->load->view('frontend/default/include/header');
?>


<style>

    /* Style the tab */
    .tab {
        float: left;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        width: 100%;
        height: 100%;
    }

    /* Style the buttons inside the tab */
    .tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 9px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px 12px;
        border: 1px solid #ccc;
        width: 70%;
        border-left: none;
        height: 100%;
        width: 100%;
    }

    .tb {
        margin-top: 50px;
        margin-bottom: 50px;
    }


    input[type=text], select, textarea {
        width: 100%;
        padding: 7px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 0px;
        margin-bottom: 11px;
        resize: vertical;
    }

    input[type=submit] {
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .inp {
        height: 40px !important;
    }

    }


</style>
<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">User Dashboard </h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>

                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ul>
        </div>
    </div>
    <ul class="shape-group">
        <li class="shape-1">
            <span></span>
        </li>
        <li class="shape-2 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-13.png')?>" alt="shape"></li>
        <li class="shape-3 scene"><img data-depth="-2" src="<?php echo base_url('uploads/system/images/about/shape-15.png')?>" alt="shape"></li>
        <li class="shape-4">
            <span></span>
        </li>
        <li class="shape-5 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-07.png')?>" alt="shape"></li>
    </ul>
</div>
<!--=====================================-->
<!--=        Blog Area Start            =-->
<!--=====================================-->

<?php
$user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
?>

<section>
    <div class="container tb">
        <div class="row">


            <div class="col-md-2" style="padding:0px">
                <div class="tab">

                    <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">

                        <?php
                        $img = 'uploads/user_image/' . $user_details['image'].'.jpg';
                        if (file_exists($img)) {
                        ?>
                            <img src="<?php echo base_url('uploads/user_image/' .$user_details['image'].'.jpg'); ?>" style="width: 100%; border-radius: 50%;">

                        <?php }else{?>
                            <img src="<?php echo base_url('uploads/user_image/placeholder.png'); ?>" style="width: 100%;border-radius: 50%;">
                        <?php }?>


                        <center>
                            <b style="alignment: center"><?php echo $user_details['first_name']." ".$user_details['last_name']?> </b>
                        </center>
<!--                        <b style="alignment: center">--><?php //echo $user_details['first_name']." ".$user_details['last_name']?><!-- </b>-->
                    </button>

                    <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen"> Profile</button>
                    <button class="tablinks" onclick="openCity(event, 'Paris')">Account</button>
                    <button class="tablinks" onclick="openCity(event, 'Tokyo')"> Update Photo</button>
                </div>
            </div>

            <div class="col-md-10" style="padding:0px">




                <div id="London" class="tabcontent">
                    <div class=" col-lg-12">

                        <br>
                        <h2 style="margin:0px">Profile </h2>
                        <p style="margin:0px">Add information about yourself to share on your profile.</p>

                        <form action="<?php echo site_url('home/update_profile/update_basics'); ?>" method="post">
                            <label for="fname">
                                First Name
                            </label>
                            <input type="text" id="fname" class="inp" name="first_name" placeholder="Your name.."
                                   value="<?php echo $user_details['first_name']; ?>">

                            <label for="lname">
                                Last Name
                            </label>
                            <input type="text" id="lname" class="inp" name="last_name" placeholder="Your last name.."
                                   value="<?php echo $user_details['last_name']; ?>">

                            <label for="contact">
                                Contact Number
                            </label>
                            <input type="text" id="contact" class="inp" name="contact" placeholder="Your contact..."
                                   value="<?php echo $user_details['contact']; ?>">

                            <label for="subject">
                                Biography
                            </label>
                            <textarea id="subject" name="biography" placeholder=" Biography..."
                                      style="height:50px"><?php echo $user_details['biography']; ?></textarea>

                            <?php
                            $dats = json_decode($user_details['social_links'], true);
                            ?>
                            <label for="facebook">
                                Facebook
                            </label>
                            <input type="text" id="facebook" class="inp" name="twitter_link" placeholder="twitter  Link"
                                   value="<?php echo $dats['facebook']; ?>">

                            <label for="twitter">
                                Twitter
                            </label>
                            <input type="text" id="twitter" class="inp" name="facebook_link" placeholder="Facebook Link"
                                   value="<?php echo $dats['twitter'] ?>">

                            <label for="linkedin">
                                Linkedin
                            </label>
                            <input type="text" id="linkedin" class="inp" name="linkedin_link" placeholder=" Linkedin Link"
                                   value="<?php echo $dats['linkedin'] ?>">


                            <button class="edu-btn btn-medium" type="submit">Submit <i class="icon-4"></i></button>
                        </form>
                        <br>

                    </div>


                </div>
                <div id="Paris" class="tabcontent">
                    <br>
                    <h2 style="margin:0px">Account </h2>
                    <p style="margin:0px">Add information about yourself to share on your profile.</p>


                    <form action="<?php echo site_url('home/update_profile/update_credentials'); ?>" method="post">

                        <input type="text" id="lname" name="email" placeholder="Email ID"
                               value="<?php echo $user_details['email'] ?>">

                        <input type="text" id="lname" name="current_password" placeholder="Current Password">

                        <input type="text" id="lname" name="new_password" placeholder="Enter New-Password">

                        <input type="text" id="lname" name="confirm_password" placeholder="Re-Type Your Password">


                        <button class="edu-btn btn-medium" type="submit">Save <i class="icon-4"></i></button>
                    </form>
                    <br>
                </div>

                <div id="Tokyo" class="tabcontent">
                    <br>
                    <h2 style="margin:0px">Account </h2>
                    <p style="margin:0px"> Update Your Photo.</p>
                    <br>


                    <form action="<?php echo site_url('home/update_profile/update_photo'); ?>"
                          enctype="multipart/form-data" method="post">

                        <input type="file" name="user_image" id="user_image">
                        <button class="edu-btn btn-medium" type="submit">Submit <i class="icon-4"></i></button>

                    </form>
                    <br>
                </div>

            </div>
        </div>
</section>


<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>


<?php
$this->load->view('frontend/default/include/footer');
?>

