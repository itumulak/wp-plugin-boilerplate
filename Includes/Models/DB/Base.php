<?php
namespace Itumulak\Includes\Models\DB;

use Itumulak\Includes\Interfaces\CRUD;
use Itumulak\Includes\Models\Data\QueryWhere;
use WP_Error;
use wpdb;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Base implements CRUD {
	const PREFIX = 'sample_';
	public string $table_name;
	protected wpdb $db;
	protected string $collate = 'utf8mb4_unicode_520_ci';
	protected string $charset = 'utf8mb4';

	public function __construct( string $table_name ) {
		global $wpdb;

		$this->db         = $wpdb;
		$this->table_name = $this->format_table_name( $table_name );
	}

	private function format_table_name( string $table_name ): string {
		return $this->db->prefix . $this::PREFIX . $table_name;
	}

	protected function table_exists(): bool {
		return $this->db->get_var( "SHOW TABLES LIKE '{$this->table_name}'" ) === $this->table_name;
	}

	protected function get_charset_collate(): string {
		return sprintf( 'DEFAULT CHARACTER SET %s COLLATE %s', $this->charset, $this->collate );
	}

	public function insert( array $data ): int|WP_Error {
		$response = $this->db->insert( $this->table_name, $data );

		if ( ! $response ) {
			return new WP_Error(
				'insert_failed',
				'Insert failed',
				array(
					'data'     => $data,
					'response' => $response,
					'query'    => $this->db->last_query,
				)
			);
		}

		return $this->db->insert_id;
	}

	public function get( array|string $where ): array|WP_Error {
		if ( is_array( $where ) ) {
			$where = $where ? $this->build_where_query( $where ) : '';
		}

		$response = $this->db->get_row(
			"SELECT * FROM {$this->table_name} $where",
			ARRAY_A
		);

		if ( ! $response ) {
			$error = new WP_Error(
				'not_found',
				'Data not found'
			);

			return $error;
		}

		return is_array( $response ) ? $response : new WP_Error( 'invalid_response', 'Unexpected response type' );
	}

	public function get_records( QueryWhere $where ): array|WP_Error {
		$where_query = $where->build_query();

		$response = $this->db->get_results(
			"SELECT * FROM {$this->table_name} $where_query",
			ARRAY_A
		);

		return is_array( $response ) ? $response : new WP_Error( 'invalid_response', 'Unexpected response type' );
	}

	public function update( array $where, array $data ): bool|WP_Error {
		$response = $this->db->update(
			$this->table_name,
			$data,
			$where
		);

		if ( false === $response ) {
			return new WP_Error(
				'update_failed',
				'Update failed',
			);
		}

		return $response;
	}

	public function delete( array $where ): int|false {
		$response = $this->db->delete(
			$this->table_name,
			$where
		);

		return $response;
	}

	public function insert_or_update( array $where, array $data ): int|bool|WP_Error {
		$existing = $this->get( $where );

		if ( $existing instanceof WP_Error ) {
			return $this->insert( $data );
		} else {
			$this->update( $where, $data );

			return $existing['ID'];
		}
	}

	public function count_records( ?QueryWhere $where = null ): int {
		$where_query = '';
		$count       = 0;

		if ( ! is_null( $where ) ) {
			$where_query = $where->build_query();
		}

		$response = $this->db->get_var(
			"SELECT COUNT(*) FROM {$this->table_name} $where_query"
		);

		if ( ! is_null( $response ) ) {
			$count = $response;
		}

		return $count;
	}

	public function query( string $query ): array|WP_Error {
		return $this->db->get_results( $query, ARRAY_A );
	}

	public function build_where_query( ?array $conditions, ?array $search = array(), ?array $date_range = array() ): string {
		$where = array();

		if ( ! empty( $conditions ) ) {
			foreach ( $conditions as $column => $value ) {
				$escaped_val = is_string( $value ) ? "'" . addslashes( $value ) . "'" : $value;
				$where[]     = "`$column` = $escaped_val";
			}
		}

		if ( ! empty( $search ) ) {
			foreach ( $search['columns'] as $column ) {
				$needle           = $search['needle'];
				$search_clauses[] = "$column LIKE '%$needle%'";
			}

			$where[] = '(' . implode( ' OR ', $search_clauses ) . ')';
		}

		if ( ! empty( $date_range ) ) {
			foreach ( $date_range as $column => $range ) {
				if ( ! empty( $range['start'] ) ) {
					$start   = addslashes( $range['start'] );
					$where[] = "`$column` >= '$start'";
				}
				if ( ! empty( $range['end'] ) ) {
					$end     = addslashes( $range['end'] );
					$where[] = "`$column` <= '$end'";
				}
			}
		}

		return ! empty( $where ) ? 'WHERE ' . implode( ' AND ', $where ) : '';
	}
}
