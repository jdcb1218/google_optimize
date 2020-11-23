<?php
/**
* Plugin Name: Google Optimaze
* Plugin URI: http://wpplugin.es
* Description: Este plugln trabaja con el modelo de (Google Optimaze).
* Version: 1.0.0
* Author: Juan Ceballos
* Author URI: http://ester-ribas.com
* Requires at least: 4.0
* Tested up to: 4.3
*
*Text Domain: wpplugin-ejemplo
* Domain path: /languages/
*/

include_once dirname(__FILE__)  . '/krumo/class.krumo.php';
include_once dirname(__FILE__)  . '/includes/widget.php';
include_once dirname(__FILE__)  . '/includes/services.php';
include_once dirname(__FILE__)  . '/includes/webform.php';

krumo::$skin = 'orange';

// INVOKE HOOK INIT
add_action('init', function() {
	global $wp;
	$url = add_query_arg($wp->query_vars);
	$url_path = reset(explode("?", urldecode($url)));
	$url_admin = strpos($url_path, 'wp-admin');

	// Get @Keyworks 
	if ($_SERVER[REQUEST_URI] != '/' && $url_path != '/wp-login.php' && $url_admin != TRUE) {
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$data = array_filter(explode("/", $actual_link));
		$keyword = end($data);
	}else{
		$data =	get_web_service($_COOKIE['google_optimize_token']);
		$storage = json_decode($data);
		$keyword = $storage->content->category;
	}

	// krumo($keyword);
	// krumo($_COOKIE['google_optimize_token']);

	//	Generate cookie keyword
    if (!isset($_COOKIE['google_optimize_keyword']) && $_SERVER[REQUEST_URI] != '/' && $url_path != '/wp-login.php' && $url_admin != TRUE) {
     	setcookie('google_optimize_keyword', $keyword , strtotime('+100000 week'), '/');
    }
	// Generate cookie Google Optimize
    if (!isset($_COOKIE['google_optimize_token']) && $_SERVER[REQUEST_URI] != '/' && $url_path != '/wp-login.php' && $url_admin != TRUE ) {
    		$token = uniqid();
	     	setcookie('google_optimize_token', $token , strtotime('+100000 week'), '/');
	     	set_web_service($token,$keyword);
	}else{ 
		// Update values base unic cookie
    	$token = $_COOKIE['google_optimize_token'];
    	set_web_service($token,$keyword);
    }
});

// INVOKE HOOK WIDGETS
add_action( 'widgets_init', function(){
	register_widget( 'Keywords_Widget' );
});

if (!function_exists('add_action')) die();
	$google_optimize_path = plugin_basename(__FILE__); 

/* INVOKE HOOK ACTIONS LINKS */
function google_optimize_plugin_action_links($links, $file) {
	global $google_optimize_path;
	
	if ($file == $google_optimize_path) {
		
		$google_optimize_links = '<a href="'. get_admin_url() .'options-general.php?page='. $google_optimize_path .'">'. esc_html__('Settings', 'google_optimize') .'</a>';
		
		array_unshift($links, $google_optimize_links);
		
	}
	return $links;
}
add_filter ('plugin_action_links', 'google_optimize_plugin_action_links', 10, 2);

/* INVOKE HOOK PAGE */
function google_optimize_add_options_page() {
	global $google_optimize_plugin;
	add_options_page($google_optimize_plugin, esc_html__('Google Optimaze Form', 'google_optimize'), 'manage_options', __FILE__, 'google_optimize_render_form');
	
}
add_action ('admin_menu', 'google_optimize_add_options_page');

/* INVOKE HOOK ENQUEUE_SCRIPT */
function google_optimize_enqueue_script() {   
    wp_enqueue_script( 'google_optimize_script', plugin_dir_url( __FILE__ ) . 'js/script.js', array('jquery'), '1.0' );
}
add_action('wp_enqueue_scripts', 'google_optimize_enqueue_script');

/* INVOKE HOOK_INSTAL */
global $google_optimize_db_version;
$google_optimize_db_version = '1.0';

function google_optimize_install() {
	global $wpdb;
	global $google_optimize_db_version;

	$table_name = $wpdb->prefix . 'google_optimaze_get_services';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		hosts varchar(55) DEFAULT '' NOT NULL,
		ports varchar(55) DEFAULT '' NOT NULL,
		endpoint varchar(55) DEFAULT '' NOT NULL,
		parameters varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	add_option( 'google_optimize_db_version', $google_optimize_db_version );
}
register_activation_hook( __FILE__, 'google_optimize_install');
register_uninstall_hook('uninstall.php', 'google_optimize_uninstall');
?>