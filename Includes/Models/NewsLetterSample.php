<?php
namespace Itumulak\Includes\Models;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Models\DB\NewsLetterSample as NewsLetterSampleDB;
use Itumulak\Includes\Models\Data\QueryWhere;
use WP_Error;

class NewsLetterSample {
    private NewsLetterSampleDB $db;

    public function __construct() {
        $this->db = new NewsLetterSampleDB();
    }

    public function add( string $email ): int|false|WP_Error {
        $where = new QueryWhere( 1, null, array( 'email' => $email ), null, null );
        $recorded = $this->db->count_records( $where );

        if ( 0 === $recorded ) {
            try {
                $data = array( $email, true, date( 'Y-m-d H:i:s' ) );
                return $this->db->insert( $data );
            } catch ( WP_Error $e ) {
                return $e;
            }
        }

        return false;
    }
}