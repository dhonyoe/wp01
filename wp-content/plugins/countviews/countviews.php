<?php

/*
  Plugin Name: Count Post Views Plugin
  Plugin URI: http://testplugin.com/
  Description: This is a plugin to count post views
  Author: Test
  Version: 1.0
  Author URI: http://testplugin.com
 */



function cpv_activate() {
    add_option('cpv_status', 'on');
    update_option('cpv_status', 'on');

    global $wpdb;

    $table_name = $wpdb->prefix . 'postviews';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
  id int(8) NOT NULL AUTO_INCREMENT,
  post_id int(10) NOT NULL,
  views int(10) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function cpv_deactivate() {
    update_option('cpv_status', 'off');
    //global $wpdb;

    //$table_name = $wpdb->prefix . 'postviews';
}

function cpv_uninstall() {
    global $wpdb;
    update_option('cpv_status', 'off');
    $table_name = $wpdb->prefix . 'postviews';
    $sql = "DROP TABLE $table_name;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'cpv_activate');
register_deactivation_hook(__FILE__, 'cpv_deactivate');
register_uninstall_hook(__FILE__, 'cpv_uninstall');

function cpv_update_view($content) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'postviews';
    $data = array();
    $data['post_id'] = get_the_ID();

    $querystr = "SELECT views FROM $table_name WHERE post_id = {$data['post_id']} LIMIT 1";

    if (!is_front_page()) {
        $pageposts = $wpdb->get_results($querystr, OBJECT);

        if (!$pageposts) {
            $data['views'] = 1;
            $wpdb->insert($table_name, $data);
        } else {
            $data['views'] = ($pageposts[0]->views) + 1;
            $wpdb->update($table_name, $data, array('post_id' => $data['post_id']));
        }
    }
    return $content;
}

add_filter('the_content', 'cpv_update_view');


