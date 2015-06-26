<?php
/*
 * Plugin Name: WP-Security
 * Plugin URI: http://www.ananthsri.info
 * Version: 0.10
 * Author: anantshri
 * Description: Based on multiple years of sec exploits this plugin basically works like a mask all for major security issues and give you a clean control panel to work with.
 */
 
 
function remove_header_info() {
    if (get_option('wpsec_extra_feed_disable'))
    {
        remove_action('wp_head', 'feed_links_extra', 3);
    }
    remove_action('wp_head', 'rsd_link');
    if (get_option('wpsec_windows_live_disable'))
    {
	    remove_action('wp_head', 'wlwmanifest_link');
    }
    if (get_option('wpsec_generator_disable'))
    {
	    remove_action('wp_head', 'wp_generator');
    }
    if (get_option('wpsec_realtional_link_disable'))
    {
	
        remove_action('wp_head', 'start_post_rel_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head',10,0); // for WordPress >= 3.0
    }
    if (get_option('wpsec_remove_shortlink'))
    {
        remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // removes wordpress short link 
    }
    if (get_option('wpsec_feed_disable'))
    {
	remove_action('wp_head', 'feed_links', 2); // Remove Post and Comment Feeds
    }
}
add_action('init', 'remove_header_info');

if (get_option('wpsec_hide_version_feeds'))
{
    add_filter('the_generator', '__return_false');
}
if (get_option('wpsec_hide_version_files'))
{
    function at_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
    }
    add_filter( 'style_loader_src', 'at_remove_wp_ver_css_js', 9999 );
    add_filter( 'script_loader_src', 'at_remove_wp_ver_css_js', 9999 );
}
if (get_option('wpsec_disable_pingback'))
{
    /*Disable ping back scanner and complete xmlrpc class. */
    add_filter( 'wp_xmlrpc_server_class', '__return_false' );
    add_filter('xmlrpc_enabled', '__return_false');
}
if (get_option('wpsec_multisite_reg_disable') and is_multisite())
{
function rbz_prevent_multisite_signup()
{
    wp_redirect( site_url() );
    die();
}
add_action( 'signup_header', 'rbz_prevent_multisite_signup' );

}

?>
<?php
function wpsec_options_admin()
{
    $wpsec_options = array(
        "wpsec_feed_disable"=>"Disable Feeds",
        "wpsec_remove_shortlink" => "Remove shortlinks wp.lnk entries",
        "wpsec_generator_disable" => "Disable Generator MetaTag",
        "wpsec_windows_live_disable" => "Disable Windows Live writer link",
        "wpsec_extra_feed_disable" => "Disable Extra feed links",
        "wpsec_realtional_link_disable" => "Disable Relational Link",
        "wpsec_hide_version_files" => "remove wp version from file src's",
        "wpsec_hide_version_feed" => "remove wp version meta tag and from rss feed",
        "wpsec_disable_pingback" => "Disable Pingback",
        "wpsec_multisite_reg_disable" => "Disable redirection to signup page on multisite website"
    );
?>
<h2><center>WP-Security Options</center></h2>
<form action="options.php" method="post">
<?php wp_nonce_field('update-options'); ?>

<table border=1>
<tr><td style="width:300px">Parameter</td><td style="width:100px"><center>Value</center></td></tr>
<?php
$options_save_name="";
foreach ($wpsec_options as $wpsec_option_name => $wpsec_option_value)
{
echo '<tr><td>'. $wpsec_option_value . '</td><td><center><input type="checkbox"'. (get_option($wpsec_option_name)?" checked ":" "). 'name="'. $wpsec_option_name .'" id='. $wpsec_option_name .'></center></td></tr>';
$options_save_name=$options_save_name . $wpsec_option_name . ",";
}
?>
<tr><td>Submit Form</td><td><center><input type="submit" value="Save Changes" /></center></td>

</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="<?php echo $options_save_name; ?>" />
</form>
<?php
}
add_action('admin_menu', 'wpsec_plugin_menu');
function wpsec_plugin_menu(){
add_options_page('Wordpress Security', 'Wordpress Security', 'manage_options', 'wpsec_options', 'wpsec_options_admin');
}
