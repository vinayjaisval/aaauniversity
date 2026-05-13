

<link rel="favicon" href="<?php echo base_url().'assets/frontend/default/img/icons/favicon.ico' ?>">
<link rel="apple-touch-icon" href="<?php echo base_url().'assets/frontend/default/img/icons/icon.png'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/jquery.webui-popover.min.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/custom.css'; ?>">

<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/select2.min.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/slick.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/slick-theme.css'; ?>">
<!-- font awesome 5 -->
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/fontawesome-all.min.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/bootstrap.min.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/bootstrap-tagsinput.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/main.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/responsive.css'; ?>">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url().'assets/global/toastr/toastr.css' ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css" />
<script src="<?php echo base_url('assets/backend/js/jquery-3.3.1.min.js'); ?>"></script>

<style>
    #subject {
  border: 1px solid #ced4da;
  border-radius: 6px;
  padding:10px 10px;
}


.btn.btn-primary {
  background: transparent;
    background-color: transparent;
  background-color: transparent;
  border-color: #505763;
  color: #686f7a;
}

.rating {
  padding-bottom: 14px;
}
.card-bodyleft:hover {background: transparent !important;color: black !important;}

.card-bodyleft {background: transparent !important;color: black !important;padding:0px 10px;}
</style>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" style="color: #00007f;font-size: 20px;
font-weight: 700;"> REQUEST AN ENQUIRY<br>we usually respond in seconds</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
<div class="content-title-box">

</div>
<form action="#" method="post" id="login">
<div class="content-box">
<div class="basic-group">
    
    <div class="form-group">
<label for="login-email"><span class="input-field-icon"><i class="fas fa-user"></i></span> User Name:</label>
<input type="text" class="form-control" name="email" id="name" placeholder="Name" value="" required="">
</div>


<div class="form-group">
<label for="login-email"><span class="input-field-icon"><i class="fas fa-envelope"></i></span> Email:</label>
<input type="email" class="form-control" name="email" id="login-email" placeholder="Email" value="" required="">
</div>
<div class="form-group">
<label><span class="input-field-icon"><i class="fas fa-phone"></i></span> Mobile No:</label>
<input type="text" class="form-control" name="password" placeholder="Mobile No" value="" required="">
</div>



<div class="form-group">
    <label><span class="input-field-icon"><i class="fas fa-pen"></i></span> Write something:</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:100px;width:100%"></textarea>
</div>

    
</div>
</div>
<div class="content-update-box">
 <button class="btn" type="submit" style="background: #673ab7;border: none;">Submit Now</button>
 <button class="btn" data-dismiss="modal" type="submit" style="float: right;">Close</button>
</div>

</form>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
      </div>

    </div>
  </div>
</div>

