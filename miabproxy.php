<?php

$config = array(
	"domain"			=> "box.example.com", // Change only this
	"endpoint"			=> "/admin/dns/custom/",
	);
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="MIAB DNS Proxy Script"');
    header('HTTP/1.0 401 Unauthorized');
    die("Authentication required!");
}
if(isset($_GET['address'])){
	$fields_string = "";
	$url = "https://".$config['domain'].$config['endpoint']."/".$_GET['address'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_USERPWD, $_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	$data = curl_exec($ch);
	if(curl_errno($ch)){
    	echo 'Request Error: ' . curl_error($ch);
	}
	curl_close($ch);
	var_dump($data);
} else {
	header('HTTP/1.1 400 Client Error', true, 400);
	die("You must have 'address' as a GET variable to verify with.");
}

?>
