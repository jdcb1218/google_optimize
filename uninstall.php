<?php
	function google_optimize_uninstall(){
	    if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
		    global $wpdb; global $google_optimize_db_version;
	    	$table_name = $wpdb->prefix . 'google_optimaze_get_services';
	    	$wpdb->query( "DROP TABLE IF EXISTS" .$table_name );
	    	delete_option($google_optimize_db_version);
	}
?>