<?php
/* Plugin Name: OWASP Top 10 Vulnerable WordPress Plugin
 * Description: Intentionally vulnerable plugin for plugin author education
 * Version: 0.1
 * Author: Anant Shrivastava
 * Author URI: http://anantshri.info
 * License: GPLv2+
 *              
 * DO NOT RUN THIS PLUGIN ON AN INTERNET ACCESSIBLE SITE
 */

function vuln_admin_main() {
	?>
	<h1>Vulnerabilities Listed below</h1>
	<br />
	<a href="?page=vuln_a10&noheader=true&u=?page=vuln">A10 - Redirects </a>
	<br /><a href="?page=vuln_a9">A9 - Insecure Library </a>
	<br /><a href="?page=vuln_a8&name=test">A8 - Cross Site Request Forgery</a>
	<br /><a href="?page=vuln_a7">A7 - Missing Function Level Access Checks</a>
	<br /><a href="?page=vuln_a6">A6 - Sensitive Data Exposure</a>
	<br /><a href="?page=vuln_a5&u=http://google.com">A5 - Security Miscofiguration</a>
	<br /><a href="?page=vuln_a4&u=../readme.html">A4 - Insecure Direct Object reference</a>
	<br /><a href="?page=vuln_a3&input=HelloEveryone">A3 - Cross Site Scripting</a>
	<br /><a href="?page=vuln_a2">A2 - Broken Authentication </a>
	<br /><a href="?page=vuln_a1&id=1">A1 - Injection </a>
	<?php
}

function vuln_a2() {
	//include('');
}

function vuln_a1() {
	global $wpdb;
	$qr = "SELECT * FROM " . $wpdb->prefix . "options WHERE option_id = " . $_GET['id'];
	//$qr="SELECT * FROM ".$wpdb->prefix."options WHERE option_id = ".esc_sql($_GET['id']);
	print $qr;
	$p = $wpdb->get_results($qr);
	foreach ($p as $entry) {
		echo "<pre>";
		print_r($p);
		echo "</pre>";
	}
}

function vuln_a3() {
	echo $_GET['input'];
	//echo esc_html($_GET['input']);
}

function vuln_a10() {
	if (is_user_logged_in() && isset($_GET['u'])) {
		ob_start();
		ob_clean();
		ob_flush();
		wp_redirect($_GET['u']);
		//wp_safe_redirect($_GET['u']);
	} else {
		echo "Enter a parameter to redirect in URL";
	}
}

function vuln_a9() {
	echo "Upload Functionality Proudly Powered by swfupload";
	echo "<script src='" . plugins_url('swfupload.js', __FILE__) . "' />";
}

function vuln_a8() {
	if (isset($_GET['name'])) {
		echo $_GET['name'];
	}
}

function vuln_a6() {
	include(plugin_dir_path(__FILE__) . 'phpinfo.php');
}

function vuln_a5() {
	include('http://aaaaa');
	/* if ((include($_GET['u'])) == FALSE)
	  {
	  echo "Can't Include This File";
	  } */
}

function vuln_a4() {
	if ((include($_GET['u'])) == FALSE) {
		echo "Can't Include This File";
	}
}

add_action('admin_menu', 'wpsec_plugin_menu');

function wpsec_plugin_menu() {
	add_menu_page('Vulnerabilities', 'Vulnerabilities', 'manage_options', 'vuln', 'vuln_admin_main');
	add_submenu_page('vuln', 'A10 Redirect Check', 'A10 Redirect Check', 'manage_options', 'vuln_a10', 'vuln_a10');
	add_submenu_page('vuln', 'A9 Insecure Library', 'A9 Insecure Library', 'manage_options', 'vuln_a9', 'vuln_a9');
	add_submenu_page('vuln', 'A8 Cross Site Request Forgery', 'A8 Cross Site Request Forgery', 'manage_options', 'vuln_a8', 'vuln_a8');
	add_submenu_page('vuln', 'A7 Missing Function Level Access Checks', 'A7 Missing Function Level Access Checks', 'manage_options', 'vuln_a7', 'vuln_a7');
	add_submenu_page('vuln', 'A6 Sensitive Data Exposure', 'A6 Sensitive Data Exposure', 'manage_options', 'vuln_a6', 'vuln_a6');
	add_submenu_page('vuln', 'A5 Security Miscofiguration', 'A5 Security Miscofiguration', 'manage_options', 'vuln_a5', 'vuln_a5');
	add_submenu_page('vuln', 'A4 Insecure Direct Object reference', 'A4 Insecure Direct Object reference', 'manage_options', 'vuln_a4', 'vuln_a4');
	add_submenu_page('vuln', 'A3 Cross Site Scripting', 'A3 Cross Site Scripting', 'manage_options', 'vuln_a3', 'vuln_a3');
	add_submenu_page('vuln', 'A2 Broken Authentication', 'A2 Broken Authentication', 'manage_options', 'vuln_a2', 'vuln_a2');
	add_submenu_page('vuln', 'A1 Injection', 'A1 Injection', 'manage_options', 'vuln_a1', 'vuln_a1');
}
