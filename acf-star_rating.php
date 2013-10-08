<?php
/*
Plugin Name: Advanced Custom Fields: Star Rating
Plugin URI: http://plugins.findingsimple.com
Description: Adds a 'star-rating' field type for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) WordPress plugin.
Version: 1.0
Author: Finding Simple
Author URI: http://findingsimple.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


class acf_field_star_rating_plugin
{
	/*
	*  Construct
	*
	*/
	function __construct()
	{
		// set text domain
		/*
		$domain = 'acf-star_rating';
		$mofile = trailingslashit(dirname(__File__)) . 'lang/' . $domain . '-' . get_locale() . '.mo';
		load_textdomain( $domain, $mofile );
		*/
		
		add_action('acf/register_fields', array($this, 'register_fields'));	

	}
	
		
	/*
	*  register_fields
	*
	*/
	function register_fields()
	{
		include_once('star_rating.php');
		include_once('star_rating_average.php');
	}
	
}

new acf_field_star_rating_plugin();
		
?>
