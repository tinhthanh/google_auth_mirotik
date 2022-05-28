<?php
include_once 'config.php';
include_once 'gpconfig.php';
require('routeros_api.class.php');
if(isset($_GET['code'])){
	$gclient->authenticate($_GET['code']);
	$_SESSION['token'] = $gclient->getAccessToken();
	header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gclient->setAccessToken($_SESSION['token']);
}

if ($gclient->getAccessToken()) {
	

	$gpuserprofile = $google_oauthv2->userinfo->get();

	$nama = $gpuserprofile['given_name']." ".$gpuserprofile['family_name']; 
	$email = $gpuserprofile['email'];
	$API = new RouterosAPI();
	$API->debug = false;
	if($API->connect(	$ip_mikrotik , $user_mikrotik , $password_mikrotik )){
			try {
			$cekuser = $API->comm('/ip/hotspot/user/print',array(
					 "?name"     		=> $email,
					));		
				echo "Email" . $email  . "\n";
			if(count($cekuser)>0){
					header("location: http://$ip_hotspot/login?dst=&username=$email&password=$email");
		echo "Caught exception from router: " . count($cekuser) . "\n";
			} 
			else{
				$API->comm("/ip/hotspot/user/add", [
					"name"     		=> $email,
					"password"	 	=> $email,
					"profile"			=> "EMAIL",
					"comment"			=> "$nama",
				  ]);
					header("location: http://$ip_hotspot/login?dst=&username=$email&password=$email");
					echo "Tao moi " ;
				}
			$API->disconnect();
			} 
			catch (Exception $ex) {
			echo "Caught exception from router: " . $ex->getMessage() . "\n";
			
			}	
		 
		} else {
		  echo " Router Not Connected";
		}

} else {
	$authUrl = $gclient->createAuthUrl();
	header("location: ".$authUrl);
}

?>
