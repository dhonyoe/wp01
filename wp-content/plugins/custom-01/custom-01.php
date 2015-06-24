<?php

/*
 * Plugin Name:       Change Date
 * Plugin URI:        http://github.com/jdecode/find-html-issues
 * Description:       Change Date using Tibet font
 * Version:           1.0
 * Author:            Jagdeep Singh<jdecode@gmail.com>
 * Author URI:        http://twitter.com/jdecode
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Prevent direct access to the plugin
if (!defined('WPINC')) {
	die;
}

// Define a constant, pointing to this file path
define('CD', __FILE__);

class change_date {

	// Constructor to register activation and deactivation hooks
	function __construct() {
		register_activation_hook(CD, array('change_date', 'install'));
		register_deactivation_hook(CD, array('change_date', 'uninstall'));
		add_filter('the_content', array('change_date', 'update_post'));
		//add_filter('the_year', array('change_date', 'update_post'));
	}

	// Add option in wp-options table
	function install() {
		add_option('change_date', '1');
		update_option('change_date', '1');
	}

	// Update option in wp-options table
	function uninstall() {
		update_option('change_date', '0');
	}
	
	function update_post($content) {
		$_number_roman = array(
			0, 1, 2, 3, 4, 5, 6, 7, 8, 9
		);
		$_number_tibet = array(
			'༠', '༡', '༢', '༣', '༤', '༥', '༦', '༧', '༨', '༩',
		);

		$title = get_the_title();
		$id = get_the_ID();
		$link = get_post_permalink();
		
		$time = get_the_time();
		$new_time = str_replace($_number_roman, $_number_tibet, $time);

		
		$_comments = get_comments_number();
		$_comments = str_replace($_number_roman, $_number_tibet, $_comments);
		
		$updated_content = str_replace($_number_roman, $_number_tibet, $content);
		//return $updated_content. $_comments;
		return '<a href="'.$link.'"><b>'.
				$title.'</b></a>'.
				$updated_content.'<br />'.
				$new_time.' | ' .$_comments .'comments';
	}

}

// Initialize constructors
$cd = new change_date();

