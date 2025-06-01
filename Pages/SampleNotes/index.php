<?php
/**
 * Output Dashboard.
 * 
 * @package itumulak/wp-boilerplate
 */

use Itumulak\Includes\Shortcodes\SampleNotes;

wp_enqueue_script( SampleNotes::SCRIPT_HANDLE );
?>
<div id="sample-notes"></div>