// <?php
// $accountId = "P_WPbp0uQvuQ141e0jyqdw";
// $clientId = "0zYWQflFSO63WnZtqbfYQg";
// $clientSecret = "Np4soZKHArENwnWdCvbhzaFbRVSd6Uz4";
// $authorization = base64_encode($clientId.':'.$clientSecret);
// $headers = [
//     "Authorization: Basic $authorization"
// ];

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL,"https://zoom.us/oauth/token?grant_type=account_credentials&account_id=$accountId");
// curl_setopt($ch, CURLOPT_POST, 1);
// // curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// $server_output = curl_exec ($ch);

// curl_close ($ch);

// print  $server_output ;
// ?>
<?php
$accountId = "6dAxzO8hQEGBsW_C0wL1Ig";
$clientId = "4YIukbCwSsSZVSZjaIvUvw";
$clientSecret = "7V5dGcD5XiGBSczVhnr1dAXdkUVfSmSt";
$authorization = base64_encode($clientId.':'.$clientSecret);
$headers = [
    "Authorization: Basic $authorization"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://zoom.us/oauth/token?grant_type=account_credentials&account_id=$accountId");
curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$server_output = curl_exec ($ch);

curl_close ($ch);

print  $server_output ;
?>