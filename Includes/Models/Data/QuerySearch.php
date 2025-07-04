<?php
namespace Itumulak\Includes\Models\Data;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class QuerySearch {
	public function __construct(
		private array $columns,
		private string $needle
	) {}

	public function get_columns() {
		return $this->columns;
	}

	public function get_needle() {
		return $this->needle;
	}
}
