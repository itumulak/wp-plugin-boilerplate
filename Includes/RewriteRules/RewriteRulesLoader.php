<?php
namespace Itumulak\Includes\RewriteRules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\Loader;

class RewriteRulesLoader implements Loader {
	private array $rules = array();

	public function __construct() {
		// $this->load(); // @todo Fix an issue where WordPress will break. // phpcs:ignore
	}

	public function init(): void {
		$this->register();
	}

	public function register(): void {
		foreach ( $this->rules as $rule ) {
			$instance = new $rule();
			add_action( 'init', array( $instance, 'rewrite_rules' ) );
			add_filter( 'query_vars', array( $instance, 'query_vars' ) );
		}
	}

	public function load(): void {
		$this->rules = array(
			SampleRule::class,
		);
	}
}
