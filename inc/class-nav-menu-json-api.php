<?php
/**
 * WPCLI_Migrate_Script_source_Site Handles opening the nav_menu taxonomy to the REST API as well as packaging nav_menu_items in the JSON response
 *
 * @package wpcli-migrate-source-site
 * @author Dan Beil
 */

/**
 * WPCLI_Migrate_Script_source_Site Handles opening the nav_menu taxonomy to the REST API as well as packaging nav_menu_items in the JSON response
 *
 * @package wpcli-migrate-source-site
 * @author Dan Beil
 **/
class WPCLI_Migrate_Script_source_Site {

	/**
	 * Our Construct
	 */
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
	 * Access via http://<site-url>/wp-json/wp/v2/nav_menu
	 */
	public function alter_nav_menu_tax() {
		register_taxonomy( 'nav_menu', 'nav_menu_item', array(
			'show_in_rest' => true,
		) );
	}

} // END class

new WPCLI_Migrate_Script_source_Site();
