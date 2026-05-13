<!-- start page title -->
<style>
    #zmmtg-root {
   display:none;
}
</style>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('Webinar Url'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <!-- <h4 class="mb-2 header-title"><?php echo get_phrase('Webinar Url'); ?></h4> -->
                 
               

                          <form class="navbar-form navbar-right" id="meeting_form" action="">
                    <div class="form-group">
                        <input type="text" name="display_name" id="display_name" value="ekon" maxLength="100"
                            placeholder="Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="meeting_number" id="meeting_number" value="" maxLength="200"
                            style="width:150px" placeholder="Meeting Number" class="form-control" required>
                    </div>
                    <div class="form-group"  >
                        <input type="text" name="meeting_pwd" id="meeting_pwd" value="" style="width:150px"
                            maxLength="32" placeholder="Meeting Password" class="form-control">
                    </div>
                    <div class="form-group"  style="display:none">
                        <input type="text" name="meeting_email" id="meeting_email" value="info@ekonacademy.com" style="width:150px"
                            maxLength="32" placeholder="Email option" class="form-control">
                    </div>
                    <!-- <div class="form-group col-12">
                            <label for="name"><?php echo get_phrase('Webinar_list'); ?><span
                                        class="required">*</span></label>
                            <select name="webinar[]" class=" webinar" multiple>
                                <option value="">-- Select Webinar --</option>
                               
                            </select>
                        </div> -->
                    <div class="form-group">
                        <select id="webinar_name" name="webinar_name" >
                        <?php
                                     
                                  foreach ( $webinar as  $webinar)
                                  {



                                    ?>
                                    <option value="<?= $webinar->meeting_id ?>"><?= $webinar->title ?></option>
                                    <?php
                                  }
                                ?>
                           
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <select id="webinar_name" name="webinar_name"  onchange="calculate(this)">
                        <?php
                                     
                                  foreach ( $webinar as  $webinar)
                                  {
                                     ?>
                                    <option value="<?= $webinar->id ?>"><?= $webinar->title ?></option>
                                    <?php
                                  }
                                ?>
                           
                        </select>
                        
                    </div> -->

                    <div class="form-group">
                        <select id="meeting_role" name="meeting_role" class="sdk-select">
                            <option value=0>Attendee</option>
                            <option value=1>Host</option>
                        </select>
                    </div>
                    <div class="form-group" style="display:none">
                        <select id="meeting_china" class="sdk-select" >
                            <option value=0>Global</option>
                            <option value=1>China</option>
                        </select>
                    </div>
                    <div class="form-group"  style="display:none">
                        <select id="meeting_lang" class="sdk-select">
                            <option value="en-US">English</option>
                            <option value="de-DE">German Deutsch</option>
                            <option value="es-ES">Spanish Español</option>
                            <option value="fr-FR">French Français</option>
                            <option value="jp-JP">Japanese 日本語</option>
                            <option value="pt-PT">Portuguese Portuguese</option>
                            <option value="ru-RU">Russian Русский</option>
                            <option value="zh-CN">Chinese 简体中文</option>
                            <option value="zh-TW">Chinese 繁体中文</option>
                            <option value="ko-KO">Korean 한국어</option>
                            <option value="vi-VN">Vietnamese Tiếng Việt</option>
                            <option value="it-IT">Italian italiano</option>
                        </select>
                    </div>

                    
                    <input type="hidden" value="" id="copy_link_value" />
                    
                    <button type="submit" class="btn btn-primary" id="join_meeting">Join</button>
                   
                    <button type="submit" class="btn btn-primary" id="clear_all"  style="display">Clear</button>
                    <button type="button" link="" onclick="window.copyJoinLink('#copy_join_link')"
                        class="btn btn-primary" id="copy_join_link"  style="display:none;">Copy Direct join link</button>


                </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<form action="<?php echo site_url('admin/webinar_form/add_store'); ?>" onsubmit="return linkadd(this)">
      <input type="hidden" value="" id="joinurllink" name="join_url_link"/>
      <input type="submit" value="submit" style="display:none;" id="formsubmit">
</form>
<!--<script type="text/javascript">-->
<!--    function checkCategoryType(category_type) {-->
<!--        if (category_type > 0) {-->
<!--            $('#thumbnail-picker-area').hide();-->
<!--            $('#icon-picker-area').hide();-->
<!--        }else {-->
<!--            $('#thumbnail-picker-area').show();-->
<!--            $('#icon-picker-area').show();-->
<!--        }-->
<!--    }-->
<!--</script>-->

<script>
let ck_var_data;


    function linkadd(form)
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200)
        {
            //   console.log(this.responseText)
        }
   
    }
  xhttp.open("post", form.setAttribute("action"), true);
  var formdata = new formData(form)
  xhttp.send(form)
  return false
</script>
<script>



 join_url_link = document.getElementById('joinurllink');
 console.log(join_url_link)

 




window.addEventListener('DOMContentLoaded', function(event) {
 
  console.log('DOM fully loaded and parsed');
  websdkready();
});

function websdkready() {
  var testTool = window.testTool;
  if (testTool.isMobileDevice()) {
    vConsole = new VConsole();
  }
//   console.log("checkSystemRequirements");
//   console.log(JSON.stringify(ZoomMtg.checkSystemRequirements()));

  // it's option if you want to change the WebSDK dependency link resources. setZoomJSLib must be run at first
  // if (!china) ZoomMtg.setZoomJSLib('https://source.zoom.us/2.14.0/lib', '/av'); // CDN version default
  // else ZoomMtg.setZoomJSLib('https://jssdk.zoomus.cn/2.14.0/lib', '/av'); // china cdn option
  // ZoomMtg.setZoomJSLib('http://localhost:9999/node_modules/@zoomus/websdk/dist/lib', '/av'); // Local version default, Angular Project change to use cdn version
  ZoomMtg.preLoadWasm(); // pre download wasm file to save time.

  var CLIENT_ID = "4YIukbCwSsSZVSZjaIvUvw";
  /**
   * NEVER PUT YOUR ACTUAL SDK SECRET OR CLIENT SECRET IN CLIENT SIDE CODE, THIS IS JUST FOR QUICK PROTOTYPING
   * The below generateSignature should be done server side as not to expose your SDK SECRET in public
   * You can find an example in here: https://developers.zoom.us/docs/meeting-sdk/auth/#signature
   */
  var CLIENT_SECRET = "7V5dGcD5XiGBSczVhnr1dAXdkUVfSmSt";

  // some help code, remember mn, pwd, lang to cookie, and autofill.
  document.getElementById("display_name").value =
    "CDN" +
    ZoomMtg.getWebSDKVersion()[0] +
    testTool.detectOS() +
    "#" +
    testTool.getBrowserInfo();
  document.getElementById("meeting_number").value = testTool.getCookie(
    "meeting_number"
  );
  document.getElementById("meeting_pwd").value = testTool.getCookie(
    "meeting_pwd"
  );
  if (testTool.getCookie("meeting_lang"))
    document.getElementById("meeting_lang").value = testTool.getCookie(
      "meeting_lang"
    );

  document
    .getElementById("meeting_lang")
    .addEventListener("change", function (e) {
      testTool.setCookie(
        "meeting_lang",
        document.getElementById("meeting_lang").value
      );
      testTool.setCookie(
        "_zm_lang",
        document.getElementById("meeting_lang").value
      );
    });
  // copy zoom invite link to mn, autofill mn and pwd.
  document
    .getElementById("meeting_number")
    .addEventListener("input", function (e) {
      var tmpMn = e.target.value.replace(/([^0-9])+/i, "");
      if (tmpMn.match(/([0-9]{9,11})/)) {
        tmpMn = tmpMn.match(/([0-9]{9,11})/)[1];
      }
      var tmpPwd = e.target.value.match(/pwd=([\d,\w]+)/);
      if (tmpPwd) {
        document.getElementById("meeting_pwd").value = tmpPwd[1];
        testTool.setCookie("meeting_pwd", tmpPwd[1]);
      }
      document.getElementById("meeting_number").value = tmpMn;
      testTool.setCookie(
        "meeting_number",
        document.getElementById("meeting_number").value
      );
    });

  document.getElementById("clear_all").addEventListener("click", function (e) {
    testTool.deleteAllCookies();
    document.getElementById("display_name").value = "";
    document.getElementById("meeting_number").value = "";
    document.getElementById("meeting_pwd").value = "";
    document.getElementById("meeting_lang").value = "en-US";
    document.getElementById("meeting_role").value = 0;
    window.location.href = "/index.html";
  });

  // click join meeting button
  document
    .getElementById("join_meeting")
    .addEventListener("click", function (e) {
      e.preventDefault();
      var meetingConfig = testTool.getMeetingConfig();
      if (!meetingConfig.mn || !meetingConfig.name) {
        alert("Meeting number or username is empty");
        return false;
      }

      
      testTool.setCookie("meeting_number", meetingConfig.mn);
      testTool.setCookie("meeting_pwd", meetingConfig.pwd);

      var signature = ZoomMtg.generateSDKSignature({
        meetingNumber: meetingConfig.mn,
        sdkKey: CLIENT_ID,
        sdkSecret: CLIENT_SECRET,
        role: meetingConfig.role,
        success: function (res) {
          console.log(res.result);
          meetingConfig.signature = res.result;
          meetingConfig.sdkKey = CLIENT_ID;
          var joinUrl = "https://ekonacademy.com/webinar/meeting.html?" + testTool.serialize(meetingConfig);
          console.log(joinUrl);
        //   window.open(joinUrl, "_blank")
        ck_var_data = joinUrl
        joinmeeting(ck_var_data, meetingConfig.role)

//         $.ajax({
//     url = "ck_ajax_url",
//     method:"POST",
//     data:{'meeting_url':that,'some_data':'Some_data1'},
//     success:function(rere){
//         console.log(rere);
//     }
// })

        },
      });
    });

  function copyToClipboard(elementId) {
    var aux = document.createElement("input");
    aux.setAttribute("value", document.getElementById(elementId).getAttribute('link'));
    document.body.appendChild(aux);  
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
  }
    
  // click copy jon link button
  window.copyJoinLink = function (element) {
    var meetingConfig = testTool.getMeetingConfig();
    if (!meetingConfig.mn || !meetingConfig.name) {
      alert("Meeting number or username is empty");
      return false;
    }
    var signature = ZoomMtg.generateSDKSignature({
      meetingNumber: meetingConfig.mn,
      sdkKey: CLIENT_ID,
      sdkSecret: CLIENT_SECRET,
      role: meetingConfig.role,
      success: function (res) {
        console.log(res.result);
        meetingConfig.signature = res.result;
        meetingConfig.sdkKey = CLIENT_ID;
        var joinUrl =
          testTool.getCurrentDomain() +
          "https://ekonacademy.com/webinar/meeting.html?" +
          testTool.serialize(meetingConfig);
        document.getElementById('copy_link_value').setAttribute('link', joinUrl);
        copyToClipboard('copy_link_value')
        join_url_link.value = joinUrl
        console.log(join_url_link.value)
      },
    });
  };

}

</script>

<script>
function joinmeeting(data, role){
  alert(role);
$.ajax({
    url:"<?= base_url('admin/ajax_request')?>",
    method:"POST",
    data:{'url':data, 'role': role},
    success:function(ret_data){
        console.log(ret_data);
    }
})
    
}

$(document).on('change','#webinar_name',function(){
    var meetingId = $(this).val();
    $('#meeting_number').val(meetingId);
    // alert(meetingId);
});
    </script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/zoom/tool.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/zoom/vconsole.min.js' ?>"></script>
<!-- <script src="<?php echo base_url() . 'assets/frontend/default/assets/js/zoom/index.js' ?>"></script> -->
<script src="https://source.zoom.us/2.14.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.14.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.14.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.14.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.14.0/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-2.14.0.min.js"></script>  

   