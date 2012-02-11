<?php
/*
Plugin Name: Sk Replace Howdy
Plugin URI: http://spottedkoi.com/plugins/sk-replace-howdy
Description: This plugin allows you to manage the "Howdy" message in your WordPress admin
Version: 1.0
Author: Contact Spotted Koi for WordPress help
Author URI: http://spottedkoi.com/?utm_source=skreplacehowdy&utm_medium=pluginpage&utm_campaign=skreplacehowdy
Notes: got the idea from here: http://wp-snippets.com/replace-howdy-in-wordpress-3-3-admin-bar/
*/

class sk_replace_howdy{
	const fieldId = 'sk_replace_howdy-message';

	// replace WordPress Howdy in WordPress 3.3
	function replace( $wp_admin_bar ) {
	    $my_account = $wp_admin_bar->get_node('my-account');
	    $newtitle = str_replace( 'Howdy,', get_option(sk_replace_howdy::fieldId), $my_account->title );            
	    $wp_admin_bar->add_node( array(
	        'id' => 'my-account',
	        'title' => $newtitle,
	    ) );
	}
	
	function process($args) {
		$greeting = get_option(sk_replace_howdy::fieldId);
		echo '<input name="'.sk_replace_howdy::fieldId.'" id="'.sk_replace_howdy::fieldId.'" type="text" value="'.($greeting == false ? 'Howdy' : $greeting).'" class="regular-text" />';
	}
	
	function admin_init() {
		add_filter( 'admin_bar_menu', array('sk_replace_howdy', 'replace'), 25);
		
		add_settings_field(sk_replace_howdy::fieldId, 
							'Replace "Howdy" with: ', 
							array('sk_replace_howdy', 'process'), 
							'general');
	 	register_setting('general', sk_replace_howdy::fieldId);
	}
}
add_action('admin_init', array('sk_replace_howdy', 'admin_init'));
?>