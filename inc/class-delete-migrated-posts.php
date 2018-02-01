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
		 * If we do not have a transient set of deleted post IDs we create it here
		 */
		if ( false === ( $deleted_posts = get_transient( 'deleted_posts' ) ) ) {
			$deleted_posts = array();
			array_push( $deleted_posts , $id );

			set_transient( 'deleted_posts', wp_json_encode( $deleted_posts ) );
		} else {

			/**
			 * We already have a transient set so if additional posts
			 * have been delete will will add them to the transient
			 * and update it here
			 */
			$deleted_posts = get_transient( 'deleted_posts' );
			$deleted_posts = json_decode( $deleted_posts );

			if ( ! in_array( $id, $deleted_posts) ) {
				array_push( $deleted_posts, $id );
			}

			set_transient( 'deleted_posts', wp_json_encode( $deleted_posts ) );
		}
	}

	/**
	 * Creating our custom route to access our transient of deleted post ids
	 */
	public function create_route() {
		register_rest_route( 'wp/v2', '/deleted_posts', array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_deleted_posts' ),
			) )
		);
	}

	/**
	 * Actually getting our transient and returning it via the REST api
	 */
	public function get_deleted_posts() {
		/**
		 * We have a transient
		 */
		if ( false !== ( $deleted_posts = get_transient( 'deleted_posts' ) ) && ! empty( $deleted_posts ) ) {
			/**
			 * Deleting our transient as we dont need it anymore and sending our json
			 */
			delete_transient( 'deleted_posts' );
			wp_send_json( $deleted_posts );
		} else {
			return new WP_Error( 'No delete posts' );
		}
	}

} // END class

new Delete_Migrated_Posts();

