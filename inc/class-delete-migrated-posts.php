<?php
/**
 * undocumented class
 *
 * @package default
 * @author
 **/
class Delete_Migrated_Posts {

	public function __construct() {
		add_action( 'trash_post', array( $this, 'post_deleted' ) );

		add_action( 'rest_api_init', array( $this, 'create_route' ) );
	}

	public function post_deleted( $id ) {
		// wp_die( $id );

		/**
		 * @todo: create / check a transient and add a post id to an array if it was deleted
		 */
	}

	public function create_route() {
		register_rest_route( 'wp/v2', '/working', array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_deleted_posts' ),
			) )
		);
	}

	public function get_deleted_posts() {
		return 'this might work';
	}

} // END class

new Delete_Migrated_Posts();

