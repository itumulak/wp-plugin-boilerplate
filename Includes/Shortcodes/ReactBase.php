<?php
namespace Itumulak\Includes\Shortcodes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Itumulak\Includes\Interfaces\Shortcode;
use Kucrut\Vite;

class ReactBase implements Shortcode {
	public function __construct(
		protected string $base_path,
		protected string $react_path,
		protected string $script_handle,
		protected string $shortcode,
	) {}

	public function get_shortcode(): string {
		return $this->shortcode;
	}

	public function render( array $atts ): string|false {
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

		ob_start();
		load_template( $this->base_path, true );
		return ob_get_clean();
	}

	public function scripts(): void {
		Vite\enqueue_asset(
			WPPB_PATH . 'dist',
			$this->react_path,
			array(
				'handle'           => $this->script_handle,
				'dependencies'     => array( 'wp-components' ),
				'css-dependencies' => array( 'wp-components' ),
				'css-media'        => 'all',
				'in-footer'        => true,
			)
		);
	}
}
