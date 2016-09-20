<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '266150530435918'; //Facebook App ID
$appSecret = '8a40cba44c6c71e03332174a7e60f80c'; // Facebook App Secret
$homeurl = 'https://gobarra.com/facebook_login_with/';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
?>