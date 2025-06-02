<?php
namespace Itumulak\Includes\Models\DB;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\DBTable;
use  Itumulak\Includes\Models\DB\Base;

class SampleNotes extends Base implements DBTable {
    const TABLE_NAME = 'sample_notes';

    public function __construct() {
        parent::__construct( self::TABLE_NAME );
    }

    public function create(): void {
        $this->db->query( "CREATE TABLE {$this->table_name} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) NOT NULL,
            note text NOT NULL COLLATE $this->collate,
            note_created DATETIME NOT NULL COLLATE $this->collate,
            PRIMARY KEY (id)
        ) {$this->get_charset_collate()}" );

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}