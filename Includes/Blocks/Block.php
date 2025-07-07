<?php
namespace Itumulak\Includes\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Block {
	public function __construct( private string $folder ) {
		$this->register();
	}

	public function register(): void {
		register_block_type( $this->get_block_file() );
	}

	protected function get_block_file(): string {
		$block_path = WPPB_PATH . 'dist';

		return sprintf( '%s/%s/block.json', $block_path, $this->folder );
	}
}
