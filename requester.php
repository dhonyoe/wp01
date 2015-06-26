<?php

function get_response($URL, $context) {
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

$data = array(
	'title' => 'abc',
	'content' => 'Testing',
	'status' => '4',
	'date_time' => time()
);

$_json = json_encode($data);

echo get_response('http://127.0.0.1/dev/jd/github/wp01/insert_data.php', $_json);
		