<?php
namespace Itumulak\Includes\Routes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Controllers\SampleNotes as SampleNotesController;
use Itumulak\Includes\Interfaces\Router;
use Itumulak\Includes\Models\Data\QueryWhere;
use Itumulak\Includes\Models\Data\SampleNotes as SampleNotesData;
use Itumulak\Includes\Routes\Base;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

class SampleNotes extends Base implements Router {
	const ENDPOINT = '/notes';
	private SampleNotesController $controller;

	public function __construct() {
		$this->controller = new SampleNotesController();
	}

	public function register_routes(): void {
		register_rest_route(
			self::BASE,
			self::ENDPOINT,
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_notes' ),
				'permission_callback' => '__return_true',
			)
		);

		register_rest_route(
			self::BASE,
			self::ENDPOINT,
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'save_note' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	public function get_notes( WP_REST_Request $request ): WP_REST_Response|WP_Error {
		$limit  = $request->get_param( 'limit' ) ?? 9999;
		$page   = $request->get_param( 'page' ) ?? 1;
		$offset = ( $page - 1 ) * $limit;

		$where = new QueryWhere(
			conditions: array(),
			limit: $limit,
			offset: $offset,
			date_range: null,
			search: null
		);

		$response = $this->controller->get( $where );
		$notes    = array();

		foreach ( $response as $note ) {
			$notes[] = array(
				'user_id'      => $note->get_user_id(),
				'note'         => $note->get_note(),
				'note_created' => $note->get_note_created(),
			);
		}

		return rest_ensure_response( $notes );
	}

	public function save_note( WP_REST_Request $request ): WP_REST_Response|WP_Error {
		$post = $request->get_json_params();

		$note = new SampleNotesData(
			user_id: get_current_user_id(),
			note_created: gmdate( 'Y-m-d H:i:s' ),
			note: $post['note'],
		);

		$response = $this->controller->add( $note );
		return rest_ensure_response( $response );
	}
}
