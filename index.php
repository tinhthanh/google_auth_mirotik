<?php
include_once 'libraries/google-client/Google_Client.php';
include_once 'libraries/google-client/contrib/Google_Oauth2Service.php';
session_start();
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
   $profile = $_SESSION['access_profile'];
   echo "<img src='".$profile['image']."' width='200px'/><br>";
   echo "Selamat datang <b>".$profile['displayName']."(".$profile['emails'].")</b>, welcome ";
 } 
 else 
 {
 echo "<center>
 <h1>Pls login</h1>
 <a href='auth.php'>Login Website</a>
 ";
 }
?>