<?php

include_once dirname(__FILE__)  . '/krumo/class.krumo.php';
include_once dirname(__FILE__)  . '/includes/widget.php';
krumo::$skin = 'orange';

function set_web_service($token,$keyword){
 	// Set End Point Google Optimaze
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => '104.131.169.113:5024/register?user_id='.$token.'&language=SPN&category='.$keyword.'&page='.$keyword.'',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	));
	$response = curl_exec($curl);
	curl_close($curl);
	echo $response;
}

function get_web_service($token){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => '104.131.169.113:5024/test-query?user_id='.$token.'',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	));

	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}