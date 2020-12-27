<?php
/**
 * Plugin Name: WP Website Templates
 * Plugin URI: https://github.com/ramphor/website-templates-wordpress-plugin
 * Description: Create website templates for WordPress website
 * Version: 0.0.1
 * Author: Ramphor Premium
 * Author URI: https://puleeno.com
 */

use Ramphor\WebsiteTemplate\WebsiteTemplate;

if ( ! defined( 'WP_WEBSITE_TEMPLATES_PLUGIN_FILE' ) ) {
	define( 'WP_WEBSITE_TEMPLATES_PLUGIN_FILE', __FILE__ );
}

$composer_autload = sprintf( '%s/vendor/autoload.php', dirname( __FILE__ ) );
if ( file_exists( $composer_autload ) ) {
	require_once $composer_autload;
}

// If class WebsiteTemplate is not found this plugin is incorrect. So the process load the plugin will be stopped
if ( ! class_exists( WebsiteTemplate::class ) ) {
	return;
}

if ( ! function_exists( 'wp_website_templates' ) ) {
	function wp_website_templates() {
		return WebsiteTemplate::get_instance();
	}
}

$GLOBALS['wpwt'] = wp_website_templates();
