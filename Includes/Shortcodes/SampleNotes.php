<?php
namespace Itumulak\Includes\Shortcodes;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\Shortcode;
use Kucrut\Vite;

class SampleNotes implements Shortcode {
    private const SHORTCODE = 'sample_notes';
    private const SCRIPT_HANDLE = 'sample-notes';

    public static function get_shortcode(): string {
        return self::SHORTCODE;
    }

    public function render( array $atts ): string|false {
        wp_enqueue_script( self::SCRIPT_HANDLE );

        ob_start();
        load_template( WPPB_PATH . 'Pages/SampleNotes/index.php', true );
        return ob_get_clean();
    }

    public function scripts(): void {
        Vite\register_asset(
            WPPB_PATH . 'dist',
            'src/pages/SampleNotes/main.jsx',
            array(
                'handle' => self::SCRIPT_HANDLE,
                'dependencies' => array('wp-components'),
                'css-dependencies' => array('wp-components'),
                'css-media' => 'all',
                'in-footer' => true
            )
        );
    }
}