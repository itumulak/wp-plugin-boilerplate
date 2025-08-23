<?php
namespace Itumulak\Includes\Models;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Models\DB\NewsLetterSample as NewsLetterSampleDB;
use Itumulak\Includes\Models\Data\QueryWhere;
use WP;
use WP_Error;

class NewsLetterSample {
    private NewsLetterSampleDB $db;

    public function __construct() {
        $this->db = new NewsLetterSampleDB();
    }

    public function add( string $email ): int|WP_Error {
        try {
            $data = array( 'email' => $email, 'is_subscribed' => true, 'date_added' => date( 'Y-m-d H:i:s' ) );
            return $this->db->insert( $data );
        } catch ( WP_Error $e ) {
            return $e;
        }
    }

    public function update( string $email, bool $is_subscribed ): bool|WP_Error {
        try {
            $where = array( 'email' => $email );
            $data = array( 'is_subscribed' => $is_subscribed );
            return $this->db->update( $where, $data );
        } catch ( WP_Error $e ) {
            return $e;
        }
    }

    public function does_record_exists( string $email ): bool|WP_Error {
        try {
            $where = new QueryWhere( 1, null, array( 'email' => $email ), null, null );
            return $this->db->count_records( $where );
        } catch ( WP_Error $e ) {
            return $e;
        }
    }
}