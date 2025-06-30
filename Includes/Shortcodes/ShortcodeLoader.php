<?php
namespace Itumulak\Includes\Shortcodes;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\Loader;
use Itumulak\Includes\Shortcodes\SampleNotes;

class ShortcodeLoader implements Loader {
    private array $shortcodes;

    public function __construct() {
        $this->load();
    }

    public function init(): void {
        add_action( 'init', array( $this, 'register' ) );
    }

    public function register(): void {
        foreach ( $this->shortcodes as $shortcode ) {
            add_shortcode( $shortcode::get_shortcode(), array( new $shortcode, 'render' ) );
        }
    }
    
    public function load(): void {
        $this->shortcodes = array(
            SampleNotes::class
        );
    }
}
