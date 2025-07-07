<?php
namespace Itumulak\Includes\Roles;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\Loader;
use Itumulak\Includes\Roles\Developer;

class RoleLoader implements Loader {
    private array $roles;

    public function __construct() {
        $this->load();
    }

    public function init(): void {
        add_action( 'init', array( $this, 'register' ) );
    }

    public function register(): void {
        foreach ( $this->roles as $role ) {
            $instance = new $role();
            add_role( $instance->get_role(), $instance->get_display_name(), $instance->get_capabilities() );
        }
    }

    public function load(): void {
        $this->roles = array(
            Developer::class
        );
    }
}