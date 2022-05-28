<?php
include_once 'config.php';
	$API = new routeros_api();
	$API->debug = false;
if($API->connect($ip_mikrotik, $user_mikrotik, $password_mikrotik)){
$username 	= $_POST['username'];
$nama		= $_POST['nama'];
$nomor		= $_POST['wa'];
	try {
	$cekuser = $API->comm('/ip/hotspot/user/print',array(
			"?name"     => $username,
			));
	if(count($cekuser)>0){
			header("location: http://$ip_hotspot/login?dst=&username=$username&password=$username");
	}else{
    $API->comm("/ip/hotspot/user/add", array(
			"server"		=> "all",
			"profile"		=> "EMAIL",
			"name"     		=> $username,
			"password"		=> $username,
			"comment"		=> "$nomor-$nama",
			));
   	header("location: http://$ip_hotspot/login?dst=&username=$username&password=$username");		}
		$API->disconnect();
	} 
	catch (Exception $ex) {
	echo "Caught exception from router: " . $ex->getMessage() . "\n";
	}	
 
} else {
  echo " Router Not Connected";
  }
?>