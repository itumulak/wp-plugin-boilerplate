<?php
namespace Itumulak\Includes\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class Block {
    protected function get_block_file( string $folder ): string {
        $block_path = WPPB_PATH . 'Pages/blocks/';
    
        return sprintf( 'Pages/blocks/%s/block.js', WPPB_PATH, $folder );
    }

    protected function get_main_file( string $folder ): string {
        return sprintf( 'src/blocks/%s/index.jsx', WPPB_PATH, $folder );
    }
}