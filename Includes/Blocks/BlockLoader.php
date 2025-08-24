<?php
namespace Itumulak\Includes\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class BlockLoader {
	public function init(): void {
		add_action( 'init', array( $this, 'blocks' ) );
	}

	public function blocks(): void {
		new Block( 'blocks/newsletter-sample' );
	}
}
