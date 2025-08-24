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

	protected function get_block_path(): string {
		return sprintf( '%s/build/%s', WPPB_PATH, $this->folder );
	}

	protected function get_block_file(): string {
		return sprintf( '%s/block.json', $this->get_block_path() );
	}

	protected function get_block_manifest(): string {
		return sprintf( '%s/blocks-manifest.php', $this->get_block_path() );
	}
}
