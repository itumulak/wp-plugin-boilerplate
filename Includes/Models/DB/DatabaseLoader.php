<?php
namespace Itumulak\Includes\Models\DB;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Models\DB\SampleNotes;

class DatabaseLoader {
	public function init(): void {
		( new SampleNotes() )->create();
		( new NewsLetterSample() )->create();
	}
}
