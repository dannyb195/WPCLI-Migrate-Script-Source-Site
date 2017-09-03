<?php


/**
 * undocumented class
 *
 * @package default
 * @author
 **/
class WPCLI_User_Migration_API {

	/**
	 * Our construct
	 */
	public function __construct() {
		add_filter( 'rest_prepare_user', array( $this, 'alter_user_object' ), 99, 3 );
	}

	/**
	 * Adding data to the user object returned by the JSON API
	 * @param  object $response As provided by the JSON API
	 * @param  object $user     WP_User Object
	 * @param  WP_REST_Request  Request object.
	 * @return object           JSON API response object
	 */
	public function alter_user_object( $response, $user, $request ) {

		$response->data['user_email'] = $user->data->user_email;
		$response->data['role'] = $user->roles[0];

		return $response;
	}

} // END class

new WPCLI_User_Migration_API();
