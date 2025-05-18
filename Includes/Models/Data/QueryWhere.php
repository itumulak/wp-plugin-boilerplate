<?php
namespace Itumulak\Includes\Models\Data;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class QueryWhere {
    public function __construct(
        private ?int $limit,
        private ?int $offset,
        private ?array $conditions,
        private ?QueryDateRange $date_range,
        private ?QuerySearch $search
    ) {}

    public function get_limit(): ?int {
        return $this->limit;
    }

    public function get_offset(): ?int {
        return $this->offset;
    }

    public function get_conditions(): array {
        return $this->conditions;
    }

    public function get_date_range(): QueryDateRange {
        return $this->date_range;
    }

    public function get_search(): QuerySearch {
        return $this->search;
    }

    public function build_query(): string {
        $where = array();

        // Handle key = value conditions
        if ( $this->conditions ) {
            foreach ( $this->conditions as $column => $value) {
                $escapedVal = is_string($value) ? "'" . addslashes($value) . "'" : $value;
                $where[] = "$column = $escapedVal";
            }
        }
        
        // Handle search
        if ( $this->search ) {
            foreach ( $this->search->get_columns() as $column ) {
                $search_clauses[] = "$column LIKE '%{$this->search->get_needle()}%'";
            }
        
            $where[] = '(' . implode( ' OR ', $search_clauses ) . ')';
        }

        // Handle date range
        if ( $this->date_range ) {
            if ( $this->date_range->get_start_date() ) {
                $where[] = "`{$this->date_range->get_column()}` >= '" . $this->date_range->get_start_date() . "'";
            }

            if ( $this->date_range->get_end_date() ) {
                $where[] = "`{$this->date_range->get_column()}` <= '" . $this->date_range->get_end_date() . "'";
            }
        }

        $query = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
        $query .= $this->limit ? " LIMIT $this->limit" : '';
        $query .= $this->offset ? " OFFSET $this->offset" : '';

        return $query;
    }
}