<?php
namespace Itumulak\Includes\Interfaces;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

interface RewriteRule {
	public function register(): void;
	public function rewrite_rules(): void;
	public function query_vars( array $vars ): array;
}
