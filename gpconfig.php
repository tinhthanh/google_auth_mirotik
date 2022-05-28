<?php
session_start();
include_once 'libraries/google-client/Google_Client.php';
include_once 'libraries/google-client/contrib/Google_Oauth2Service.php';

$client_id ='223844694133-pnmq0ofafp4un02rpogbfjivs1nogr4u.apps.googleusercontent.com'; // Google client ID
$client_secret = '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'; // Google Client Secret
$redirect_url = 'https://wifi.isbnetwork.vn/google_auth/auth.php'; // Callback URL

// Call Google API
$gclient = new Google_Client();
$gclient->setClientId($client_id); 
$gclient->setClientSecret($client_secret); 
$gclient->setRedirectUri($redirect_url); 
$gclient->setScopes(array(
    "profile",
    "email",
   ));

$google_oauthv2 = new Google_Oauth2Service($gclient);
?>
