<?php
namespace Itumulak\Includes\Models\Data;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class QueryDateRange {
    public function __construct(
        private string $column,
        private string $start_date,
        private ?string $end_date
    ) {}

    public function get_column(): string {
        return $this->column;
    }

    public function get_start_date(): string {
        return $this->start_date;
    }

    public function get_end_date(): ?string {
        return $this->end_date;
    }
}