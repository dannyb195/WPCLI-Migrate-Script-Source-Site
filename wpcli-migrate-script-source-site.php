<?php
/**
 * Plugin Name: WPCLI Migrate Script Source Site
 * Plugin URI: https://github.com/dannyb195/WPCLI-Migrate-Script-Source-Site
 * Description: This plugin is a companion to https://github.com/dannyb195/WPCLI-Migrate-Script and should be installed on the site providing data to be migrated. It opens up the nav_menu taxonomy to the JSON REST API and will handle opening up Meta Data as well in the future.
 * Author: Dan Beil
 * Version: .0
 * Author URI: http://addactiondan.me
 *
 * @package wpcli-migrate-source-site
 * @author Dan Beil
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	wp_die( __( "Cheatin' Huh?", 'wpcli-source-site' ) );
}

/**
 * nav_menu
 */
require_once( __DIR__ . '/inc/class-nav-menu-json-api.php' );
