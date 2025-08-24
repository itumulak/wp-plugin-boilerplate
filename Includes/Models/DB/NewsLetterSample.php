<?php
namespace Itumulak\Includes\Models\DB;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\DBTable;
use Itumulak\Includes\Models\DB\Base;

class NewsLetterSample extends Base implements DBTable {
	const TABLE_NAME = 'newsletter';

	public function __construct() {
		parent::__construct( self::TABLE_NAME );
	}

	public function create(): void {
		$this->db->query(
			"CREATE TABLE {$this->table_name} (
               ID bigint(20) NOT NULL AUTO_INCREMENT,
               email text NOT NULL COLLATE $this->collate,
               is_subcribed tinyint(1) NOT NULL DEFAULT 1,
               date_added DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
               date_updated DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
               PRIMARY KEY (ID)
           ) {$this->get_charset_collate()}"
		);

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}
}
