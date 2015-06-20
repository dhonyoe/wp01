<?php

/*
 * Plugin Name:       Find HTML Issues
 * Plugin URI:        http://github.com/jdecode/find-html-issues
 * Description:       Find HTML Issues within a web page.
 * Version:           1.0
 * Author:            Jagdeep Singh<jdecode@gmail.com>
 * Author URI:        http://twitter.com/jdecode
 * Text Domain:       single-post-meta-manager-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
	die;
}

define('FHI', __FILE__);

require_once 'functions.php';

class find_html_issues {

	/**
	 * Parsed HTML data from the loaded HTML page
	 */
	private $_html = '';

	function __construct() {
		register_activation_hook(FHI, array('find_html_issues', 'install'));
		register_deactivation_hook(FHI, array('find_html_issues', 'uninstall'));
	}

	function install() {
		add_option('find_html_issues', '1');
		update_option('find_html_issues', '1');
	}

	function uninstall() {
		update_option('find_html_issues', '0');
	}

	function add_admin_menu() {
		add_action('admin_menu', array($this, 'admin_menu'));
	}

	function admin_menu() {
		add_menu_page('Find HTML/SEO Issues on page', 'FHI', 'manage_options', 'find-html-issues/ui.php', '', '');
	}

	function show_form() {
		echo '!';
	}

	function get_post_data($curl) {
		$this->_html = $curl->get_url_data();
		$this->parseHtml();
	}

	function parseHtml() {

		//$this->_html = str_replace("<!DOCTYPE html>", "", $this->_html);
		/*
		$p = xml_parser_create();
		xml_parse_into_struct($p, $this->_html, $vals, $index);
		xml_parser_free($p);
		echo "Index array\n";
		pr($index);
		echo "\nVals array\n";
		pr($vals);
		die;
		*/
		/*
		$this->_html = str_replace("<!DOCTYPE html>", "", $this->_html);
		$__data = new SimpleXMLElement($this->_html);
		pr($__data); die;
		*/

		$dom = new DOMDocument();
		//echo htmlentities($this->_html); die;
		libxml_use_internal_errors(true);
		//$this->_html = str_replace("<!DOCTYPE html>", "", $this->_html);
		//$this->_html = str_replace("</h1>", "", $this->_html);
		//echo htmlentities($this->_html); die;
		//echo htmlentities($this->_html); die;
		$dom->loadHTML($this->_html);
		
		foreach ($dom->getElementsByTagName('img') as $node) {
			$array[] = $dom->saveHTML($node);
		}

		pr($array);
		//die;
	}

}

$fhi = new find_html_issues();
$fhi->add_admin_menu();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$curl = new cfunctions();
	$fhi->get_post_data($curl);
}