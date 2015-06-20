<?php

class cfunctions {

	/**
	 *
	 * @var boolean | Variable that defines if the data is POST or not
	 */
	private $is_post = false;

	/**
	 *
	 * @var array  | Array containing basic authentication variables
	 */
	private $httpauth = array('username' => 'jdecode', 'password' => '');

	public function __construct() {
		
	}

	/**
	 * 
	 * @param string $url URL for curl request
	 * @param array $post_fields POST data, if any, blank/null otherwise
	 * @return string curl response
	 */
	public function _get_curl_data($url = null, $post_fields = array()) {
		$this->is_post = false;
		if (!is_null($post_fields) && is_array($post_fields) && count($post_fields)) {
			$this->is_post = true;
			$post_data = $this->_create_post_string($post_fields);
		}

		$curl = curl_init();
		$header = $this->_get_headers();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		//curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate,sdch');
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		if ($this->is_post) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, "$post_data");
		}

		$data = curl_exec($curl); // execute curl request 
		curl_close($curl);
		return $data;
	}

	/**
	 * 
	 * @param array $post_fields POST array, that needs to be sent to the curl URL
	 * @param booleans $json If the return format needs to be JSON then TRUE, FALSE otherwise
	 * @return string If JSON is TRUE, then JSON formatted string, query string otherwise
	 */
	private function _create_post_string($post_fields = null, $json = true) {
		if ($json) {
			return $this->_create_json($post_fields);
		}
		$post_data = '';
		if (is_null($post_fields) || !is_array($post_fields) || !count($post_fields)) {
			$post_data = '';
		} else {
			$this->is_post = true;
			$first = true;
			foreach ($post_fields as $k => $post_field) {
				if ($first) {
					$post_data .= "$k=$post_field";
					$first = false;
				} else {
					$post_data .= "&$k=$post_field";
				}
			}
		}
		return $post_data;
	}

	/**
	 * 
	 * @return array Creates an array of the headers that need to be passed along with the curl request
	 */
	private function _get_headers() {
		$header = array();
		$header[] = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Keep-Alive:timeout=".rand(10,15).", max=".rand(80,120);
		$header[] = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.3";
		$header[] = "Accept-Language:es-ES,es;q=0.8";
		//$header[] = "Authorization: ";
		$header[] = "Pragma: ";
		if (!empty($this->httpauth)) {
			$header[] = 'Authorization: Basic ' . base64_encode("{$this->httpauth['username']}:{$this->httpauth['password']}");
		}


		return $header;
	}

	/**
	 * 
	 * @param array $array Array that needs to be JSON encoded
	 * @return string JSON encoded string
	 */
	public function _create_json($array = null) {
		return json_encode($array);
	}
	
	function get_url_data() {
		$url = $_POST['url'];
		return $this->_get_curl_data($url);
	}

	function get_lists() {
		//$url = 'https://us9.api.mailchimp.com/3.0/lists/';
		$url = 'https://us9.api.mailchimp.com/3.0/lists/53d8981a54/members/';
		return $this->_get_curl_data($url);
	}

	function get_campaigns() {
		//$url = 'https://us9.api.mailchimp.com/3.0/lists/';
		$url = 'https://us9.api.mailchimp.com/3.0/campaigns/';
		return $this->_get_curl_data($url);
	}

	function add_member($data) {
		//$url = 'https://us9.api.mailchimp.com/3.0/lists/';
		$url = 'https://us9.api.mailchimp.com/3.0/lists/53d8981a54/members/';
		return $this->_get_curl_data($url, $data);
	}
	
	function about_me() {
		$url = 'https://us9.api.mailchimp.com/3.0/';
		return $this->_get_curl_data($url);
	}

}

/**
 * This method prints out the array on the browser in a human-readable format
 * 
 * @param array $arr Array that needs to be printed on the browser
 */
function pr($arr) {
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

/**
 * Prints the array using pr() method, and then stops execution
 * 
 * @param string $arr
 */
function prx($arr) {
	pr($arr);
	die();
}
