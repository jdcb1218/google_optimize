<?php
/**
* Plugin Name: Google Optimaze
* Plugin URI: http://wpplugin.es
* Description: Este plugln genera csv (Google Optimaze).
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

/* Render Form */
function google_optimize_render_form() {
	$google_optimize_path    = 'google_optimize/google_optimize.php'; 	
	$form_submit =  get_admin_url() . 'options-general.php?page='. $google_optimize_path .'';
	$host_set_data = $_POST['host_set_data'];
?>
	<form action="<?php print($form_submit); ?>" method="post">
		<!-- Fielset web-services Metod @Post -->		
		<fieldset class="set-data-webservices">
			<h1>Configuracion @Set Data (#Web-services)</h1>
			  <h3>HOST</h3>
			  <input type="text" name="host_set_data" maxlength="100" value="<?=$host_set_data;?>" />
			  <h3>PORTS</h3>
			  <input type="text" name="ports_set_data" maxlength="100" value="<?=$varMovie;?>" />			  
			  <h3>END-POINT</h3>
			  <input type="text" name="endpoint_set_data" maxlength="100" value="<?=$varMovie;?>" />	
			  <h3>PARAMETERS</h3>
			  <input type="text" name="parameters_set_data" maxlength="100" value="<?=$varMovie;?>" />	
		</fieldset> 
		<!-- Fielset web-services Metod @Get -->	
		<fieldset class="get-data-webservices">
			<h1>Configuracion @Get Data (#Web-services)</h1>
			  <h3>HOST</h3>
			  <input type="text" name="host_get_data" maxlength="100" value="<?=$varMovie;?>" />
			  <h3>PORTS</h3>
			  <input type="text" name="ports_get_data" maxlength="100" value="<?=$varMovie;?>" />			  
			  <h3>END-POINT</h3>
			  <input type="text" name="endpoint_get_data" maxlength="100" value="<?=$varMovie;?>" />	
			  <h3>PARAMETERS</h3>
			  <input type="text" name="parameters_get_data" maxlength="100" value="<?=$varMovie;?>" />	
		</fieldset> 
		<input type="submit" name="formSubmit" value="Submit" />
	</form>
<?php }