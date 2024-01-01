<?php
require 'files/functions.php';
if(!isset($_SESSION['username'])){ die('<span style="color:red">Vui lòng đăng nhập trước khi tạo!</span>');} else {
     $sodu = DB::queryFirstField("SELECT sodu FROM `users` WHERE username = '".$_SESSION['username']."'");
     if($_GET['type'] == 'demo'){
         $tiengoc = 0;
     }
     if($sodu < $tiengoc){
         die('<span style="color:red">Số dư không đủ!</span>');
     } else {
  DB::query("UPDATE users SET sodu=sodu-$tiengoc WHERE username = '".$_SESSION['username']."'");
         // Get data from the request
$type = $_GET['type'];

// Prepare data
$inputData = array(
    'key' => $key,
    'theme' => trim($_POST['theme']),
    'time_dt' => $_POST['time_dt'],
    'pin' => $_POST['pin'],
    'stk_nhan' => $_POST['stk_nhan'],
    'name_nhan' => $_POST['name_nhan'],
    'amount' => $_POST['amount'],
    'bank_nhan' => $_POST['bank_nhan'],
    'code' => $_POST['code'],
    'code1' => $_POST['code1'],
    'magiaodich' => $_POST['magiaodich'],
    'noidung' => $_POST['noidung'],
    'bdsd' => $_POST['bdsd'],
    'sdc' => $_POST['sdc'],
    'stkgui' => $_POST['stkgui'],
    'name_gui' => $_POST['name_gui'],
    'time_bill' => $_POST['time_bill']
);

// Create cURL resource
$ch = curl_init();

// Configure cURL options
curl_setopt($ch, CURLOPT_URL, "https://demo.fakebillck.com/banks/".trim($_POST['bank_goc'])."/api.php?type=" . $type);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $inputData);

// Execute cURL session and store the result
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

// Close cURL resource
curl_close($ch);

// Output the response
echo $response;
     }
}

?>