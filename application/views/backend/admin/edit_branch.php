<?php


$state = $this->db->order_by('name','asc')->get_where('states', array('country_id' => '101'))->result_array();
$cities = $this->db->order_by('name','asc')->get_where('cities', array('country_id' => '101'))->result_array();

?>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title"><p><?php echo get_phrase('Edit_branch_location'); ?></p></h4>
            <form class="" action="<?php echo site_url('admin/branch_form/edit_form/'.$branch_details[0]['id']); ?>" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label><?php echo get_phrase('Branch_name'); ?></label>
                    <span class="required">*</span>
                    <input class="form-control" type="text" name="branch_name" value="<?php echo $branch_details[0]['branch_name']?>" required>
                </div>

                <div class="form-group">
                    <label><?php echo get_phrase('address'); ?></label>
                    <span class="required">*</span>
                    <input class="form-control" type="text" name="address"  value="<?php echo $branch_details[0]['address']?>"required>
                </div>
                <div class="form-group">
                    <label><?php echo get_phrase('email'); ?></label>
                    <span class="required">*</span>
                    <input class="form-control" type="email" name="email" value="<?php echo $branch_details[0]['email']?>" required>
                </div>
                <div class="form-group">
                    <label><?php echo get_phrase('google_map_link'); ?></label>
                    <span class="required">*</span>
                    <input class="form-control" type="text" name="g_map_link"  value="<?php echo $branch_details[0]['google_map_link']?>"required>
                </div>

                <?php

                $social_link  =  json_decode($branch_details[0]['social_link'],true);
                ?>
                <div class="form-group">
                    <label><?php echo get_phrase('facebook'); ?></label>
                    <input class="form-control" type="text" value="<?php echo $social_link['facebook']?>" name="facebook">
                </div>
                <div class="form-group">
                    <label><?php echo get_phrase('twitter'); ?></label>
                    <input class="form-control" type="text" value="<?php echo $social_link['twitter']?>" name="twitter">
                </div>
                <div class="form-group">
                    <label><?php echo get_phrase('linked'); ?></label>
                    <input class="form-control" type="text" value="<?php echo $social_link['linkedin']?>" name="linked">
                </div>
                <!--                <div class="form-group">-->
                <!--                    <label>--><?php //echo get_phrase('social_link'); ?><!--</label>-->
                <!--                    <input type="text" name="social_link">-->
                <!--                </div>-->


                <div class="form-group">
                    <label><?php echo get_phrase('state'); ?></label>
                    <span class="required">*</span>
                    <select class="form-control" id="state_drop_down" name="state" required>
                        <?php foreach ($state as $state_list): ?>
                            <option value="<?php echo $state_list['id'] ?>" <?php echo ($state_list['id']==$branch_details[0]['state'])?'selected':'' ?> ><?php echo $state_list['name'] ?></option>
                        <?php endforeach; ?>
                    </select>

<!--                    <input class="form-control"  type="text" name="state" value="--><?php //echo $branch_details[0]['state']?><!--" required>-->
                </div>

                <div class="form-group">
                    <label><?php echo get_phrase('city'); ?></label>
                    <span class="required">*</span>

                    <select class="form-control" id="city_drop_down" name="city" required>
                        <?php
                        foreach ($cities as $city_list): ?>
                            <option value="<?php echo $city_list['id'] ?>" <?php echo ($city_list['id']==$branch_details[0]['city'])?'selected':'' ?> ><?php echo $city_list['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
<!--                    <input  class="form-control" type="text" name="city" value="--><?php //echo $branch_details[0]['city']?><!--" required>-->
                </div>


<!--                <div class="form-group">-->
<!--                    <label>--><?php //echo get_phrase('Branch_image'); ?><!--</label>-->
<!--                    <span class="required">*</span>-->
<!--                    <input class="form-control"  type="file" name="branch_image" required>-->
<!--                </div>-->

                <div class="form-group">
                    <img id="branch_img" src="<?php echo base_url('uploads/branch_image/'.$branch_details[0]['branch_image'])?>" height="80px">
                    <label for="branch_image"><?php echo get_phrase('Branch_image'); ?><span class="required">*</span></label>
                    <input type="file" class="form-control" id="branch_image" name = "branch_image"  accept="image/png,image/jpg, image/jpeg" onchange="showPreview(event,'branch');"">
                    <input type="hidden" class="form-control" id="branch_image" name = "branch_image1"  accept="image/png,image/jpg, image/jpeg" value="<?php echo $branch_details[0]['branch_image']?>" onchange="showPreview(event,'branch');"">
                </div>

                <div class="row justify-content-md-center">
                    <div class="form-group col-md-6">
                        <button class="btn btn-block btn-primary"
                                type="submit"><?php echo get_phrase('update_branch'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showPreview(event,data) {
        if (data === 'branch') {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("branch_img");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    }


    $("select").select2();

    $('#state_drop_down').change(function (){
        let selected_city_id = "<?php echo $branch_details[0]['city']?>"
        let state_id = $('#state_drop_down').val();
        $('#city_drop_down').empty();
        $.ajax({
            url: '<?php echo base_url("admin/cities/")?>' + '/' + state_id,
            dataType: 'json',
            success: function (city) {
                $('#city_drop_down').append(`<option value="">Choose City...</option>`)
                for (let key in city) {
                    if (city !== "") {
                        let city_dropdown = `<option value="${city[key]['id']}" ${(selected_city_id == city[key]['id'])?'selected':''}>${city[key]['name']}</option>`;
                        $('#city_drop_down').append(city_dropdown)
                    }
                }
            }
        });
    })
</script>