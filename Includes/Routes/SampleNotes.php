<?php
namespace Itumulak\Includes\Routes;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Controllers\SampleNotes as SampleNotesController;
use Itumulak\Includes\Interfaces\Router;
use Itumulak\Includes\Models\Data\QueryWhere;
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
        register_rest_route( self::BASE, self::ENDPOINT, array(
            'methods' => 'GET',
            'callback' => array( $this, 'get_notes' ),
            'permission_callback' => '__return_true'
        ));
    }

    public function get_notes( WP_REST_Request $request ): WP_REST_Response|WP_Error {
        $limit = $request->get_param( 'limit' ) ?? 9999;
        $page = $request->get_param( 'page' ) ?? 1;
        $offset = ( $page - 1 ) * $limit;

        $where = new QueryWhere(
            conditions: array(),
            limit: $limit,
            offset: $offset,
            date_range: null,
            search: null
        );

        $response = $this->controller->get( $where );

        return rest_ensure_response( $response );
    }
}