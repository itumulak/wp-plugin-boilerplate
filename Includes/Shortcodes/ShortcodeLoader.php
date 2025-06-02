<?php
namespace Itumulak\Includes\Shortcodes;

if (!defined('ABSPATH')) {
    exit;
}

use Itumulak\Includes\Shortcodes\SampleNotes;

class ShortcodeLoader {
    private SampleNotes $sample_notes;

    public function __construct() {
        $this->sample_notes = new SampleNotes();
    }

    public function init(): void {
        $this->shortcodes();
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
    }

    public function scripts(): void {
        $this->sample_notes->scripts();
    }

    public function shortcodes(): void {
        add_shortcode( SampleNotes::SHORTCODE, array( $this->sample_notes, 'render' ) );
    }
}
