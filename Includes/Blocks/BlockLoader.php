<?php
namespace Itumulak\Includes\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

use Itumulak\Includes\Blocks\SampleBlock;

class BlockLoader {
    private SampleBlock $sample_block;

    public function __construct() {
        $this->sample_block = new SampleBlock();    
    }

    public function init(): void {
        add_action( 'init', array( $this, 'blocks' ) );
    }

    public function blocks():void {
        $this->sample_block->register();
    }
}