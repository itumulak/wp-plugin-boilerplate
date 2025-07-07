<?php
namespace Itumulak\Includes\Roles;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\Role;

class Developer implements Role {
    private string $role = 'developer';
    private string $display_name = 'Developer';

    public function get_role(): string {
        return $this->role;
    }

    public function get_display_name(): string {
        return $this->display_name;
    }

    public function get_capabilities(): array {
        return array(
            'switch_themes',
            'edit_theme_options',
            'install_themes',
            'update_themes',
            'delete_themes',
            'activate_plugins',
            'install_plugins',
            'update_plugins',
            'delete_plugins',
            'edit_plugins',
            'manage_options',
            'edit_theme_options',
            'list_users',
            'edit_users',
            'create_users',
            'delete_users',
            'promote_users'
        );
    }
}