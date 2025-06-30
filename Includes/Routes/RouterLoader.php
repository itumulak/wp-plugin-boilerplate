<?php
namespace Itumulak\Includes\Routes;

use Itumulak\Includes\Interfaces\Loader;
use Itumulak\Includes\Routes\SampleNotes;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class RouterLoader implements Loader {
    private array $routes;

    public function __construct() {
        $this->load();
    }

    public function init(): void {
        add_action( 'init', array( $this, 'register' ) );
    }

    public function register(): void {
        foreach ( $this->routes as $route ) {
            add_action( 'rest_api_init', array( $route, 'register_routes' ) );
        }
    }

    public function load(): void {
        $this->routes = array(
            SampleNotes::class
        );
    }
}