<?php
namespace Itumulak\Includes\Shortcodes;

if (!defined('ABSPATH')) {
    exit;
}

use Itumulak\Includes\Shortcodes\SampleNotes;

class ShortcodeLoader {
    private array $shortcodes;

    public function __construct() {
        $this->load_shortcode();
    }

    public function init(): void {
        add_action( 'init', array( $this, 'register_shortcodes' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
    }

    public function register_scripts(): void {
        foreach ( $this->shortcodes as $shortcode ) {
            $shortcode->scripts();
        }   
    }

    public function register_shortcodes(): void {
        foreach ( $this->shortcodes as $shortcode ) {
            add_shortcode( $shortcode::get_shortcode(), array( $shortcode, 'render' ) );
        }
    }
    
    private function load_shortcode(): void {
        $this->shortcodes = array(
            SampleNotes::class
        );
    }
}
