<?php
$this->load->view('frontend/default/include/header');
?>
<div class="row">

    <div class="col-3">

    </div>

    <div class="col-6">
        <form action="<?= base_url() ?>home/webinar/register_store" method="post">
            <h3>Webinar Register Form</h3>
            <div class="form-group">
                <label for="current-log-email">Name</label>
                <input type="text" name="name" class="border form-control" id="current-g-email"
                       placeholder="Name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control border" id="email" placeholder="Email" name="email">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control border" id="phone" placeholder="Phone No" name="phone">
            </div>

            <div class="form-group">
                <label for="phone">Message</label>
                <textarea class="border" rows="3" placeholder="Message..." name="message"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="edu-btn btn-medium">Webinar Register <i class="icon-4"></i></button>
            </div>
        </form>
    </div>

    <div class="col-3">

    </div>
</div>

<?php
$this->load->view('frontend/default/include/footer');
?>
