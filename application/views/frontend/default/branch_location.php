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
</div>

<!-- ================= MAIN SECTION ================= -->
<section class="section-gap-equal contact-me-area">
    <div class="container">

        <!-- ✅ IMAGE ONLY ONCE (STATIC OUTSIDE LOOP) -->
        <!-- <div class="row mb-4">
            <div class="col-md-12 text-center">
                <img 
                    src="<?php echo base_url('uploads/branch_image/' . $firstBranch['branch_image']) ?>"
                    class="img-fluid rounded"
                    style="max-height:300px; width:100%; object-fit:cover;"
                >
            </div>
        </div> -->

        <!-- ================= BRANCH LIST ================= -->
        <div class="row">

            <?php foreach ($branch as $branch_data) { 

                $state_data = $this->db->get_where('states', ['id' => $branch_data['state']])->row();
                $city_data  = $this->db->get_where('cities', ['id' => $branch_data['city']])->row();
            ?>

            <div class="col-md-6 mb-4">

                <div class="p-3 shadow-sm rounded bg-white h-100">

                    <h5><?php echo $branch_data['branch_name'] ?></h5>

                    <p>
                        <?php echo $branch_data['address']; ?>

                        <?php 
                        if (!empty($city_data->name) && !empty($state_data->name)) {
                            echo ', ' . $city_data->name . ', ' . $state_data->name;
                        }
                        ?>
                    </p>

                    <!-- <p>
                        <a href="mailto:<?php echo $branch_data['email'] ?>">
                            <?php echo $branch_data['email'] ?>
                        </a>
                    </p> -->

                </div>
            </div>

            <?php } ?>

        </div>

    </div>
</section>

<!-- ================= CONTACT FORM (UNCHANGED) ================= -->

<section class="edu-section-gap contact-form-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form">

                    <div class="section-title section-center">
                        <h3 class="title">Just Drop Me a Line</h3>
                    </div>

                    <form method="POST" action="<?php echo base_url('home/contact_us_form') ?>">
                        <div class="row row--10">

                            <div class="form-group col-lg-6">
                                <input type="text" name="contact-name" placeholder="Your Name" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <input type="email" name="contact-email" placeholder="Your Email" required>
                            </div>

                            <div class="form-group col-12">
                                <input type="text" name="contact-phone" maxlength="10" placeholder="Phone number" required>
                            </div>

                            <div class="form-group col-12">
                                <textarea name="contact-message" rows="6" placeholder="Type your message" required></textarea>
                            </div>

                            <div class="form-group col-12 text-center">
                                <button class="edu-btn submit-btn" type="submit">
                                    Submit Now
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'include/footer.php'; ?>