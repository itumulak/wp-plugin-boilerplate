<?php
namespace Itumulak\Includes\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Models\Data\QueryWhere;
use Itumulak\Includes\Models\DB\SampleNotes as SampleNotesDB;
use Itumulak\Includes\Models\Data\SampleNotes as SampleNotesObject;
use WP_Error;

class SampleNotes {
    private SampleNotesDB $db;

    public function __construct() {
        $this->db = new SampleNotesDB();
    }

    public function get( QueryWhere $where ): array|WP_Error {
        $data = array();
        $logs = $this->db->get_records( $where );

        if ( $logs instanceof WP_Error ) {
            return $logs;
        }

        foreach ( $logs as $log ) {
            $data[] = new SampleNotesObject(
                user_id: $log['user_id'],
                note: $log['note'],
                note_created: $log['note_created']
            );
        }

        return $data;
    }

    public function add( SampleNotesObject $data ): int|WP_Error {
        if ( ! $data instanceof SampleNotesObject ) {
            return new WP_Error(
                'invalid_data',
                'Invalid data type'
            );
        }

        return $this->db->insert( 
            array(
                'user_id' => $data->get_user_id(),
                'note' => $data->get_note(),
                'note_created' => $data->get_note_created()
            )
        );
    }
}