<?php

if (isset($_POST['submit'])) {
    $accessToken = "eyJzdiI6IjAwMDAwMSIsImFsZyI6IkhTNTEyIiwidiI6IjIuMCIsImtpZCI6IjA5OGMxMGY2LTc0OTUtNDQ0Yi04ZTQ1LTA2MzFjZWJjYTA5MiJ9.eyJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJHMno2b1V1cVJUYVk2VVZVVGlkU3RRIiwidmVyIjo5LCJhdWlkIjoiYTgyNDE3OWU2MzJmZDc3NmVjMTczOGU5MjU1Njg3NjQiLCJuYmYiOjE2OTI5MDA2NTcsImNvZGUiOiJqN1ZxOXU3X1JQYUtqUXRwR19ON3ZndWxPcElUTUFwdVEiLCJpc3MiOiJ6bTpjaWQ6NFlJdWtiQ3dTc1NaVlNaamFJdlV2dyIsImdubyI6MCwiZXhwIjoxNjkyOTA0MjU3LCJ0eXBlIjozLCJpYXQiOjE2OTI5MDA2NTcsImFpZCI6IjZkQXh6TzhoUUVHQnNXX0Mwd0wxSWcifQ.S9J3iB8TumAqJVt01PNxX2j0KOj0aunNxfcQYDyoQxFE6aTW2c-yQZclO3-K-NIeWnzqvHr9RZwZB9Ap2e-fYA";
    $headers = [
        "Content-Type: application/json",
        "Authorization: Bearer $accessToken"
    ];
    $topic = $_POST['topic'];
    $postData = ['topic'=>$topic];
    $postData = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://api.zoom.us/v2/users/me/meetings");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec ($ch);

    curl_close ($ch);

    print  $server_output ;

    $data=json_decode($server_output);
    print $data;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Meeting</title>
</head>
<body>
<form action="create_meeting.php" method="POST">
    Topic : <input type="" name="topic">

    <input type="submit" value="Create" name="submit">
<form>  
  
      
</body>
</html>
<script>
    window.addEventListener('DOMContentLoaded', function(event) {
  console.log('DOM fully loaded and parsed');
  websdkready();
});

function websdkready() {
  var testTool = window.testTool;
  if (testTool.isMobileDevice()) {
    vConsole = new VConsole();
  }
  console.log("checkSystemRequirements");
  console.log(JSON.stringify(ZoomMtg.checkSystemRequirements()));

  // it's option if you want to change the WebSDK dependency link resources. setZoomJSLib must be run at first
  // if (!china) ZoomMtg.setZoomJSLib('https://source.zoom.us/2.14.0/lib', '/av'); // CDN version default
  // else ZoomMtg.setZoomJSLib('https://jssdk.zoomus.cn/2.14.0/lib', '/av'); // china cdn option
  // ZoomMtg.setZoomJSLib('http://localhost:9999/node_modules/@zoomus/websdk/dist/lib', '/av'); // Local version default, Angular Project change to use cdn version
  ZoomMtg.preLoadWasm(); // pre download wasm file to save time.

  var CLIENT_ID = "Pwy7__QXT_66clDNOFVsuw";
  /**
   * NEVER PUT YOUR ACTUAL SDK SECRET OR CLIENT SECRET IN CLIENT SIDE CODE, THIS IS JUST FOR QUICK PROTOTYPING
   * The below generateSignature should be done server side as not to expose your SDK SECRET in public
   * You can find an example in here: https://developers.zoom.us/docs/meeting-sdk/auth/#signature
   */
  var CLIENT_SECRET = "bh3nkGPKx0XOxNFPGDZMUprpxfsCmsXW";

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
          var joinUrl = "https://we.hucpl.com/zoom/CDN/meeting.html?" + testTool.serialize(meetingConfig);
          console.log(joinUrl);
          window.open(joinUrl, "_blank");
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
          "https://we.hucpl.com/zoom/CDN/meeting.html?" +
          testTool.serialize(meetingConfig);
        document.getElementById('copy_link_value').setAttribute('link', joinUrl);
        copyToClipboard('copy_link_value');
        
      },
    });
  };

}
    </script>


