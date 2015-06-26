<?php

$USERNAME = "admin";
$PASSWORD = "admin";
$blogid = 1;
$wp_url = "http://127.0.0.1/dev/jd/github/wp01";
$xmlrpc_url = $wp_url . '/' . 'xmlrpc.php';

$get_blog_info = 'getUsersBlogs';


function get_response($URL, $context) {
	if (!function_exists('curl_init')) {
		die("Curl PHP package not installedn");
	}

	/* Initializing CURL */
	$curlHandle = curl_init();

	/* The URL to be downloaded is set */
	curl_setopt($curlHandle, CURLOPT_URL, $URL);
	curl_setopt($curlHandle, CURLOPT_HEADER, false);
	curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
	curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $context);
	curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

	/* Now execute the CURL, download the URL specified */
	$response = curl_exec($curlHandle);
	return $response;
}

$_obj = (object) array(
				'post_type' =>'post',
				'post_status' => 'publish',
				'post_title'=> 'Test XML RPC '.date('Y/m/d H:i:s'),
				'post_author' => 1,
				'post_excerpt' => 'Test XML RPC Excerpt',
				'post_content' => 'Test XML RPC Content | Test XML RPC Content | Test XML RPC Content | Test XML RPC Content | Test XML RPC Content | Test XML RPC Content | Test XML RPC Content | Test XML RPC Content | '
			
			);
/* Creating the wp.getUsersBlogs request which takes on two parameters
  username and password */
$request = xmlrpc_encode_request(
		"wp.newPost", 
		array(
			$blogid, 
			$USERNAME, 
			$PASSWORD,
			$_obj
		)
		);

/* Making the request to wordpress XMLRPC of your blog */
$xmlresponse = get_response($xmlrpc_url, $request);
$response = xmlrpc_decode($xmlresponse);
if ($response && xmlrpc_is_fault($response)) {
	trigger_error("xmlrpc: $response[faultString] ($response[faultCode])");
} else {
	/* Printing the response on to the console */
	echo '<pre>';
	print_r($response);
	
}
//echo "\n";
