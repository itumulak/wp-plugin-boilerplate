<?php
namespace Itumulak\Includes\Routes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Controllers\NewsLetterSample as NewsLetterSampleController;
use Itumulak\Includes\Interfaces\Router;
use Itumulak\Includes\Routes\Base;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

class NewsLetterSample extends Base implements Router {
	const NEWSLETTER = '/newsletter';
	private NewsLetterSampleController $controller;

	public function __construct() {
		$this->controller = new NewsLetterSampleController();
	}

	public function register_routes(): void {
		register_rest_route(
			self::BASE,
			self::NEWSLETTER,
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'subscribe' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	public function subscribe( WP_REST_Request $request ): WP_REST_Response|WP_Error {
		$post = $request->get_json_params();

		if ( ! $post['email'] ) {
			return new WP_Error( 'email_required', 'Email is required', array( 'status' => 400 ) );
		}

		$response = $this->controller->handle_subscribe( $post['email'] );

		return rest_ensure_response( $response );
	}
}
