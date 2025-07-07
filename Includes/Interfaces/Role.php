<?php
namespace Itumulak\Includes\Interfaces;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

interface Role {
	public function get_role(): string;
	public function get_display_name(): string;
	public function get_capabilities(): array;
}
