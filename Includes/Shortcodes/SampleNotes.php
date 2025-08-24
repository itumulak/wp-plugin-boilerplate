<?php
namespace Itumulak\Includes\Shortcodes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\Shortcode;
use Itumulak\Includes\Shortcodes\ReactBase;

class SampleNotes extends ReactBase implements Shortcode {
	private const SHORTCODE     = 'sample_notes';
	private const SCRIPT_HANDLE = 'sample-notes';

	public function __construct() {
		parent::__construct(
			base_path: WPPB_PATH . 'Pages/SampleNotes/index.php',
			react_path: 'src/pages/SampleNotes/main.jsx',
			shortcode: self::SHORTCODE,
			script_handle: self::SCRIPT_HANDLE
		);
	}
}
