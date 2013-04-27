<?php 

/*
Plugin Name: Add links to Pages
Description: Easily add page specific links to any page and display them through a widget.
Author: Jealous Designs
Author URI: http://jealousdesigns.com
Version: 0.2
*/

if (!defined("ALTP_url")) { define("ALTP_url", WP_PLUGIN_URL.'/add-links-to-pages'); } //NO TRAILING SLASH

if (!defined("ALTP_dir")) { define("ALTP_dir", WP_PLUGIN_DIR.'/add-links-to-pages'); } //NO TRAILING SLASH

include_once('includes/class-add-links-to-pages.php'); //Set up

/*
function wordpress_gallery(){ //function to allow theme developers to use this function rather than the shortcode

	new wordpress_gallery_display();

}
*/



?>