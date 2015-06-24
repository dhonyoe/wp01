<?php

session_start();

/*
  Plugin Name: Test Plugin
  Plugin URI: http://testplugin.com/
  Description: This is a test plugin
  Author: Test
  Version: 1.0
  Author URI: http://testplugin.com
 */

$_temp = array();

function tp_activate() {
    add_option('tp_status', 'on');
    update_option('tp_status', 'on');

    global $wpdb;

    $table_name = $wpdb->prefix . 'tpusers';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
  id int(8) NOT NULL AUTO_INCREMENT,
  fname varchar(64) NOT NULL,
  lname varchar(64) NOT NULL,
  email varchar(128) NOT NULL,
  password varchar(40) NOT NULL,
  status int(2) NOT NULL,
  created int(11) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);

    $data = array();
    $data['fname'] = 'abc';
    $data['lname'] = 'def';
    $data['email'] = 'abc@abc.com';
    $data['password'] = '123';
    $data['status'] = '1';
    $data['created'] = time();


    $wpdb->insert(
            $table_name, $data
    );
}

function tp_deactivate() {
    update_option('tp_status', 'off');
    global $wpdb;

    $table_name = $wpdb->prefix . 'tpusers';

    $sql = "DROP TABLE $table_name;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function tp_uninstall() {
    update_option('tp_status', 'off');

}

register_activation_hook(__FILE__, 'tp_activate');
register_deactivation_hook(__FILE__, 'tp_deactivate');
register_uninstall_hook(__FILE__, 'tp_uninstall');

function tp_append_to_post($content) {
    global $_temp;
    //die(the_ID());
    $_temp['content'] = $content;
    //$content = '<span style="background-color:green;"> ' . $content . '</span>';
    return $content;
}

add_filter('the_content', 'tp_append_to_post');

function make_post_bold($id) {
    //print_r($data);
    //die($data);
    // Update Admin via email that a post has been updated
    //wpmail();
}

add_action('post_updated', 'make_post_bold');

function html_form_code() {
    //die(the_ID());
    global $_temp;
    echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">';
    echo '<p>';
    echo 'Your Name (required) <br />';
    echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset($_POST["cf-name"]) ? esc_attr($_POST["cf-name"]) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Your Email (required) <br />';
    echo '<input type="email" name="cf-email" value="' . ( isset($_POST["cf-email"]) ? esc_attr($_POST["cf-email"]) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Subject (required) <br />';
    echo '<input type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="' . ( isset($_POST["cf-subject"]) ? esc_attr($_POST["cf-subject"]) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Your Message (required) <br />';
    echo '<textarea rows="10" cols="35" name="cf-message">' . ( isset($_POST["cf-message"]) ? esc_attr($_POST["cf-message"]) : strip_tags($_temp['content']) ) . '</textarea>';
    echo '</p>';
    echo '<p>';
    $rand = rand(100000, 999999);
    $_SESSION['cf_captcha'] = $rand;
    print_r($_SESSION['cf_captcha']);
    echo 'Captcha : ' . $rand . ' <br />';
    echo '<input type="text" name="cf-captcha" value="" size="6" />';
    echo '</p>';
    echo '<p><input type="submit" name="cf-submitted" value="Send"/></p>';
    echo '</form>';
}

function deliver_mail() {
    // if the submit button is clicked, send the email
    if (isset($_POST['cf-submitted'])) {
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
        print_r($_SESSION['cf_captcha']);
        if ($_POST['cf-captcha'] != $_SESSION['cf_captcha']) {
            echo 'CAPTCHA incorrect';
        } else {
            // sanitize form values
            $name = sanitize_text_field($_POST["cf-name"]);
            $email = sanitize_email($_POST["cf-email"]);
            $subject = sanitize_text_field($_POST["cf-subject"]);
            $message = esc_textarea($_POST["cf-message"]);

            // get the blog administrator's email address
            $to = get_option('admin_email');

            $headers = "From: $name <$email>" . "\r\n";

            // If email has been process for sending, display a success message
            echo ('Mail has been sent');
            /*
              if (wp_mail($to, $subject, $message, $headers)) {
              echo '<div>';
              echo '<p>Thanks for contacting me, expect a response soon.</p>';
              echo '</div>';
              } else {
              echo 'An unexpected error occurred';
              }
             */
        }
    }
}

function tp_shortcode() {
    ob_start();
    deliver_mail();
    html_form_code();

    return ob_get_clean();
}

add_shortcode('tp_cf', 'tp_shortcode');

function add_scripts() {
    wp_register_script('jq', plugins_url().'/testplugin/js/jquery.js');
    wp_register_script('bs', plugins_url().'/testplugin/js/bootstrap.js');
    
    wp_enqueue_script('jq');
    wp_enqueue_script('bs');
    
    
    wp_register_style('bss', plugins_url().'/testplugin/css/bootstrap.css');
    wp_enqueue_style('bss');
}

add_action('wp_enqueue_scripts', 'add_scripts');

