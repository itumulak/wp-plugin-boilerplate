<?php
namespace Itumulak\Includes\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\Block;
use Itumulak\Includes\Blocks\Block as Base;
use Kucrut\Vite;

class SampleBlock extends Base implements Block {
    const BLOCKNAME = 'my-awesome-block';

    public function register(): void {
        register_block_type( $this->get_block_file( self::BLOCKNAME ) );

        Vite\enqueue_asset(
            WPPB_PATH . 'dist',
            $this->get_main_file( self::BLOCKNAME ),
            array(
                'handle' => self::BLOCKNAME,
                'dependencies' => array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n', 'wp-data'),
                'css-dependencies' => array('wp-components', 'wp-blocks'),
                'css-media' => 'all',
                'in-footer' => true
            )
        );
    }
}