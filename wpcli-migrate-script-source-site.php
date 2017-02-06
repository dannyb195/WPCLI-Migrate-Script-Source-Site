<?php
/**
 * Plugin Name: WPCLI Migrate Script Source Site
 * Plugin URI:
 * Description:
 * Author: Dan Beil
 * Version: .0
 * Author URI: http://addactiondan.me
 */


/**
 * undocumented class
 *
 * http://test.me.dev/wp-json/wp/v2/nav_menu_item
 *
 *
 *
 * @package default
 * @author
 **/
class WPCLI_Migrate_Script_source_Site {

	public function __construct() {
		add_action( 'init', array( $this, 'alter_nav_menu_item' ) );
		add_action( 'init', array( $this, 'alter_nav_menu_tax' ) );
	}

	/**
	 * This function opens the individual nav_menu_items to the REST API
	 *
	 * Access via http://test.me.dev/wp-json/wp/v2/nav_menu_item
	 */
	public function alter_nav_menu_item() {
		register_post_type( 'nav_menu_item', array(
			'show_in_rest' => true,
		) );
	}

	/**
	 * This function opens the nav_menu taxonomy to the REST API
	 *
	 * Access via http://test.me.dev/wp-json/wp/v2/nav_menu
	 */
	public function alter_nav_menu_tax() {
		register_taxonomy( 'nav_menu', 'nav_menu_item', array(
			'show_in_rest' => true,
		) );
	}

} // END class

new WPCLI_Migrate_Script_source_Site();
