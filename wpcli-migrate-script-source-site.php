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
		add_action( 'init', array( $this, 'alter_nav_menu_tax' ) );
		add_filter( 'rest_prepare_nav_menu', array( $this, 'alter_nav_menu_object' ), 99, 3 );
	}


	/**
	 * This method adds the individual menu items to the main JSON response as requesed via WP CLI / REST API
	 * @param  object $response As provided by the rest_prepare_nav_menu filter
	 * @param  array $item      As provided by the rest_prepare_nav_menu filter
	 * @param  object $request  As provided by the rest_prepare_nav_menu filter
	 * @return object           Standard JSON response with the addition of a 'menu_items' array that holds all menu items for the particular menu
	 */
	public function alter_nav_menu_object( $response, $item, $request ) {

		$response->data['menu_items'] = wp_get_nav_menu_items( $item->term_id );

		return $response;
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
