<?php
namespace Itumulak\Includes\Interface;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Models\Data\QueryWhere;
use WP_Error;

interface CRUD {
    public function insert( array $data ): int|WP_Error;
    public function get( array|string $where ): array|WP_Error;
    public function get_records( QueryWhere $where ): array|WP_Error;
    public function update( array $where, array $data ): bool|WP_Error;
    public function delete( array $where ): int|false;
    public function insert_or_update( array $where, array $data ): int|bool|WP_Error;
    public function count_records( QueryWhere $where ): int;
    public function query( string $query ): array|WP_Error;
}